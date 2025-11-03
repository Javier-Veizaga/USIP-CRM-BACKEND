<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('prospect_id')
                ->constrained('prospects')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Renombrado para evitar confusión con el ID de esta tabla
            $table->foreignId('action_catalog_id')
                ->constrained('actions_catalog')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('response_id')
                ->constrained('responses')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Renombrado para claridad (y evitar chocar con el tipo DATE)
            $table->timestamp('acted_at')->useCurrent();

            // Si siempre vas a exigir observación, deja not null; si no, nullable()
            $table->text('observation')->nullable();
            $table->text('additional_note')->nullable();

            $table->timestamps();
            // $table->softDeletes(); // <- opcional
        });

        // Índices útiles para reportes
        Schema::table('actions', function (Blueprint $table) {
            $table->index(['user_id', 'acted_at']);
            $table->index(['prospect_id', 'acted_at']);
            $table->index('action_catalog_id');
            $table->index('response_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
