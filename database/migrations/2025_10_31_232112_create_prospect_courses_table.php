<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectCoursesTable extends Migration
{
    public function up(): void
    {
        Schema::create('prospect_courses', function (Blueprint $table) {
            $table->foreignId('prospect_id')->constrained('prospects')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnUpdate()->restrictOnDelete();
            $table->integer('priority');

            $table->primary(['prospect_id', 'course_id']);
            $table->unique(['prospect_id', 'priority']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prospect_courses');
    }
}
