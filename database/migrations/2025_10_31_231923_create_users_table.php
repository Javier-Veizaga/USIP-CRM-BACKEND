<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // PK (bigint unsigned)
            $table->id();

            // Datos personales
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('maternal_last_name', 50)->nullable();

            // Credenciales y contacto
            $table->string('email', 120)->unique();
            // Si prefieres "password_hash", cámbialo aquí y en tu modelo:
            $table->string('password', 255);
            $table->string('phone', 20)->unique();

            // Rol y estado
            $table->foreignId('role_id')
                  ->constrained('roles')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->boolean('is_active')->default(true);

            // Tokens (útil si usas login con remember me)
            $table->rememberToken();

            // Auditoría
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
