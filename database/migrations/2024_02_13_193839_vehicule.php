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
        Schema::create('vehicules', function(Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->string('model');
            $table->float('prix');
            $table->integer('km');
            $table->text('description');
            $table->date('year');
            $table->string('img')->nullable();
            $table->unsignedBigInteger('energie_id'); // Ajout de la colonne pour la clé étrangère
            $table->foreign('energie_id')->references('id')->on('energie');
            // Définition de la contrainte de clé étrangère
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
