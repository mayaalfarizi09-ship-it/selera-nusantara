<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->enum('status', ['unread', 'read', 'replied'])->default('unread')->after('subject');
        });

        DB::table('contact_messages')->where('is_read', true)->update(['status' => 'read']);
        DB::table('contact_messages')->where('is_read', false)->update(['status' => 'unread']);

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('is_read');
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->boolean('is_read')->default(false);
        });

        DB::table('contact_messages')->where('status', '!=', 'unread')->update(['is_read' => true]);

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
