<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::table('books', function (Blueprint $table) {
        // Use 'user_id' to match your Model's $fillable and relationships
        // Added nullable() to fix the SQLite "Not Null" error
        $table->foreignId('user_id')
              ->after('id') 
              ->nullable() 
              ->constrained('users') 
              ->cascadeOnDelete();
    });
}

public function down(): void
{
    Schema::table('books', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};
