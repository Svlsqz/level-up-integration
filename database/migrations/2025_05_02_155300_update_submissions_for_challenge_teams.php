<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            if (!Schema::hasColumn('submissions', 'challenge_team_id')) {
                $table->foreignId('challenge_team_id')->nullable()->after('id')->constrained('challenge_teams')->onDelete('cascade');
            }
            if (Schema::hasColumn('submissions', 'team_id')) {
                $table->dropForeign(['team_id']);
                $table->dropColumn('team_id');
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            if (Schema::hasColumn('submissions', 'challenge_team_id')) {
                $table->dropForeign(['challenge_team_id']);
                $table->dropColumn('challenge_team_id');
            }

            // Si quieres agregar team_id de nuevo:
            // $table->foreignId('team_id')->nullable()->constrained()->onDelete('cascade');
        });
    }
};
