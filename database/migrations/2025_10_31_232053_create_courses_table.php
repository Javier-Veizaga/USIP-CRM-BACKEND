<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->integer('semesters');
            $table->foreignId('faculty_id')->constrained('faculties')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();

            $table->unique(['name', 'faculty_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
}
