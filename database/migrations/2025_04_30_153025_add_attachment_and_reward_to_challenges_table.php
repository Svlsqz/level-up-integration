<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->string('attachment_path')->nullable()->after('deadline');
            $table->text('reward_description')->nullable()->after('attachment_path');
        });
    }

    public function down(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->dropColumn('attachment_path');
            $table->dropColumn('reward_description');
        });
    }
};
