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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->unsignedTinyInteger('month');
            $table->string('school_year', 9);
            $table->decimal('amount', 12, 2);
            $table->date('due_date');
            $table->string('status', 20)->default('unpaid')->index();
            $table->timestamps();

            $table->unique(['student_id', 'month', 'school_year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
