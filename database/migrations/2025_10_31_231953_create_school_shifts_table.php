<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolShiftsTable extends Migration
{
    public function up(): void
    {
        Schema::create('school_shifts', function (Blueprint $table) {
            $table->id();
            $table->string('shift', 30)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_shifts');
    }
}
