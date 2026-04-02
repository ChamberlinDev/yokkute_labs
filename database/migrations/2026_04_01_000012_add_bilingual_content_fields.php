<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('badge_en')->nullable()->after('badge');
            $table->text('description_en')->nullable()->after('description');
            $table->text('audience_en')->nullable()->after('audience');
            $table->json('deliverables_en')->nullable()->after('deliverables');
            $table->string('cta_label_en')->nullable()->after('cta_label');
            $table->string('cta_url_en')->nullable()->after('cta_url');
        });

        Schema::table('team_members', function (Blueprint $table) {
            $table->string('role_en')->nullable()->after('role');
            $table->text('bio_en')->nullable()->after('bio');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'title_en',
                'badge_en',
                'description_en',
                'audience_en',
                'deliverables_en',
                'cta_label_en',
                'cta_url_en',
            ]);
        });

        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn([
                'role_en',
                'bio_en',
            ]);
        });
    }
};
