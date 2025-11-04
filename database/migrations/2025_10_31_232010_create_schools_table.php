<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->unique();      // o sin unique si prefieres
            $table->foreignId('school_management_id')->constrained('school_management')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('school_shift_id')->constrained('school_shifts')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('agreement_type_id')->nullable()->constrained('agreement_types')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('agreement_status_id')->nullable()->constrained('agreement_statuses')->nullOnDelete()->cascadeOnUpdate();
            $table->string('address', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
}
