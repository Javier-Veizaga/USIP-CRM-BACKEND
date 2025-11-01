<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();

            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('maternal_last_name', 50)->nullable();

            $table->string('phone', 20)->unique();
            $table->foreignId('school_id')
                  ->constrained('schools')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('address', 255);

            $table->foreignId('data_origin_id')
                  ->constrained('data_sources')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('user_id') // ejecutivo asignado
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('status_id') // snapshot de estado actual del prospecto
                  ->constrained('statuses')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->timestamps();

            // Índices adicionales útiles para filtros frecuentes
            $table->index(['school_id']);
            $table->index(['user_id', 'status_id']); // consultas por ejecutivo y estado
            $table->index(['data_origin_id']);       // reportes por origen de datos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospects');
    }
}
