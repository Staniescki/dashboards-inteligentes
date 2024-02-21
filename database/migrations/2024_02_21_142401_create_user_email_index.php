<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \Illuminate\Support\Facades\DB::unprepared("CREATE UNIQUE INDEX user_email_index on users(email) WHERE deleted_at IS NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function ( \Illuminate\Database\Schema\Blueprint $table) {
            $table->dropIndex('user_email_index');
        });
    }
};
