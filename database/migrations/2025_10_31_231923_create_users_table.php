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
        Schema::create('users', function (Blueprint $table) {
            // Clave Primaria y Autoincremental
            $table->id(); // Crea un INT(PK, AUTO_INCREMENT)
            
            // Información Personal
            $table->string('first_name', 50)->notNullable();
            $table->string('last_name', 50)->notNullable();
            $table->string('maternal_last_name', 50)->nullable(); 
            
            // Credenciales y Contacto
            $table->string('email', 120)->unique()->notNullable();
            $table->string('password_hash', 255)->notNullable();
            $table->string('phone', 20)->unique()->notNullable();

            // Rol y Estado
            $table->unsignedInteger('role_id')->notNullable(); 
            $table->boolean('is_active')->notNullable()->default(true);
            
            // Tiempos de Auditoría
            $table->timestamps();            
            // Definición de la Clave Foránea (FK)
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};