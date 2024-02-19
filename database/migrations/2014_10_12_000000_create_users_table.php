<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrément
            $table->string('email')->unique(); // Email unique
            $table->string('nom');
            $table->string('password');
            $table->string('prenom');
            $table->string('role');
            $table->timestamps(); // Ajouter automatiquement les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
