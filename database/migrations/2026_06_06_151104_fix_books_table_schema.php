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
        Schema::table('books', function (Blueprint $table) {
            $table->string('file_buku')->nullable()->change();
            $table->enum('format', ['fisik', 'digital'])->default('fisik')->after('stok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('file_buku')->nullable(false)->change();
            $table->dropColumn('format');
        });
    }
};
