#!/bin/bash
# =============================================================
# deploy.sh - Production deployment for Yokkute Labs
# Usage: bash deploy.sh
# =============================================================
set -Eeuo pipefail

APP_DIR="/opt/yokkute_labs"
REPO_URL="https://github.com/ChamberlinDev/yokkute_labs.git"
BRANCH="roland"
COMPOSE_FILE="docker-compose.yml"

dc() {
    docker compose -f "$COMPOSE_FILE" "$@"
}

print_banner() {
    echo "============================================================"
    echo "  Yokkute Labs deployment"
    echo "============================================================"
}

print_step() {
    echo "[$1/7] $2"
}

on_error() {
    echo ""
    echo "Deployment failed. Current container state:"
    dc ps || true

    for container in yokkute_postgres yokkute_app yokkute_queue yokkute_scheduler; do
        if docker inspect "$container" >/dev/null 2>&1; then
            echo ""
            echo "--- Recent logs: $container ---"
            docker logs --tail 80 "$container" || true
        fi
    done
}

wait_for_container() {
    local container="$1"
    local retries="${2:-30}"
    local attempt=1
    local status=""

    while [ "$attempt" -le "$retries" ]; do
        status="$(docker inspect --format='{{if .State.Health}}{{.State.Health.Status}}{{else}}{{.State.Status}}{{end}}' "$container" 2>/dev/null || true)"

        case "$status" in
            healthy|running)
                return 0
                ;;
            unhealthy|exited|dead)
                echo "Container $container is in unexpected state: $status"
                return 1
                ;;
        esac

        sleep 2
        attempt=$((attempt + 1))
    done

    echo "Timed out while waiting for $container."
    return 1
}

ensure_running() {
    local container="$1"
    local status=""

    status="$(docker inspect --format='{{.State.Status}}' "$container" 2>/dev/null || true)"
    if [ "$status" != "running" ]; then
        echo "Container $container is not running (status: ${status:-missing})."
        docker logs --tail 80 "$container" || true
        return 1
    fi
}

artisan() {
    dc exec -T app php artisan "$@"
}

trap on_error ERR

print_banner

if [ -d "$APP_DIR/.git" ]; then
    print_step 1 "Updating code from Git..."
    cd "$APP_DIR"
    git fetch origin
    git reset --hard "origin/$BRANCH"
else
    print_step 1 "Cloning repository..."
    git clone -b "$BRANCH" "$REPO_URL" "$APP_DIR"
    cd "$APP_DIR"
fi

print_step 2 "Checking .env.production..."
if [ ! -f ".env.production" ]; then
    echo "ERROR: .env.production is missing in $APP_DIR"
    exit 1
fi

cp .env.production .env

print_step 3 "Building production image..."
dc build --no-cache app

print_step 4 "Starting database and application..."
dc up -d postgres
echo "Waiting for PostgreSQL healthcheck..."
wait_for_container "yokkute_postgres" 45

dc up -d --force-recreate --no-build app
echo "Waiting for application container..."
wait_for_container "yokkute_app" 30

print_step 5 "Running migrations and production seed..."
artisan migrate --force
artisan db:seed --class=SiteSettingSeeder --force

print_step 6 "Ensuring storage symlink..."
dc exec -T app sh -lc 'if [ -L public/storage ]; then echo "Storage link already present."; elif [ ! -e public/storage ]; then php artisan storage:link; else echo "public/storage exists but is not a symlink."; exit 1; fi'

print_step 7 "Caching Laravel and starting workers..."
artisan config:cache
artisan route:cache
artisan view:cache

dc up -d --force-recreate --no-build --remove-orphans queue scheduler
sleep 5

ensure_running "yokkute_postgres"
ensure_running "yokkute_app"
ensure_running "yokkute_queue"
ensure_running "yokkute_scheduler"

echo ""
echo "============================================================"
echo "  Deployment completed successfully"
echo "============================================================"

dc ps
