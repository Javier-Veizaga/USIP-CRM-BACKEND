<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolAgreementHistoryTable extends Migration
{
    public function up(): void
    {
        Schema::create('school_agreement_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('school_management_id')->nullable()->constrained('school_management')->nullOnDelete();
            $table->foreignId('agreement_type_id')->nullable()->constrained('agreement_types')->nullOnDelete();
            $table->foreignId('agreement_status_id')->constrained('agreement_statuses')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('changed_by', 120)->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_agreement_history');
    }
}
