<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prospect_id')->constrained('prospects')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('action_id')->constrained('actions_catalog')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('response_id')->constrained('responses')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamp('date')->useCurrent();
            $table->text('observation');
            $table->text('additional_note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
}
