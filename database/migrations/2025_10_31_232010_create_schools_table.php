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
            $table->string('name', 150);
            $table->foreignId('school_management_id')->constrained('school_management')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('school_shift_id')->constrained('school_shifts')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('agreement_type_id')->nullable()->constrained('agreement_types')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('agreement_status_id')->nullable()->constrained('agreement_statuses')->cascadeOnUpdate()->nullOnDelete();
            $table->string('address', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
}
