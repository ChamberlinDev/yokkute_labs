#!/bin/bash
# =============================================================
# deploy.sh — Déploiement Yokkute Labs sur VPS Contabo
# Usage : bash deploy.sh
# =============================================================
set -e

APP_DIR="/opt/yokkute_labs"
REPO_URL=" https://github.com/ChamberlinDev/yokkute_labs.git"
BRANCH="roland"
COMPOSE_FILE="docker-compose.yml"

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  🚀  Déploiement Yokkute Labs"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# ── 1. Pull du code ──────────────────────────────────────
if [ -d "$APP_DIR/.git" ]; then
    echo "[1/7] 🔄  Git pull..."
    cd "$APP_DIR"
    git fetch origin
    git reset --hard origin/$BRANCH
else
    echo "[1/7] 📥  Clonage initial..."
    git clone -b "$BRANCH" "$REPO_URL" "$APP_DIR"
    cd "$APP_DIR"
fi

# ── 2. Vérifier .env.production ──────────────────────────
echo "[2/7] 🔑  Vérification .env.production..."
if [ ! -f ".env.production" ]; then
    echo "ERREUR : .env.production manquant !"
    echo "Crée /opt/yokkute_labs/.env.production avec les vraies valeurs."
    exit 1
fi

# Copier comme .env actif pour le build Docker
cp .env.production .env

# ── 3. Build de l'image Docker ───────────────────────────
echo "[3/7] 🐳  Build Docker..."
docker compose -f "$COMPOSE_FILE" build --no-cache app

# ── 4. Démarrage des services ────────────────────────────
echo "[4/7] ▶️   Démarrage des containers..."
docker compose -f "$COMPOSE_FILE" up -d postgres

echo "       Attente PostgreSQL (healthcheck)..."
sleep 8

docker compose -f "$COMPOSE_FILE" up -d

# ── 5. Migrations ────────────────────────────────────────
echo "[5/7] 🗄️   Migrations base de données..."
docker compose exec -T app php artisan migrate --force

# Seeder initial (silencieux si déjà fait)
docker compose exec -T app php artisan db:seed --class=SiteSettingSeeder --force 2>/dev/null || true

# ── 6. Storage link ──────────────────────────────────────
echo "[6/7] 🔗  Storage link..."
docker compose exec -T app php artisan storage:link 2>/dev/null || true

# ── 7. Optimisations finales ─────────────────────────────
echo "[7/7] ⚡  Optimisations Laravel..."
docker compose exec -T app php artisan config:cache
docker compose exec -T app php artisan route:cache
docker compose exec -T app php artisan view:cache

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  ✅  Déploiement terminé !"
echo "  🌐  PHP-FPM sur 127.0.0.1:9000 — Nginx hôte s'en charge"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

docker compose ps
