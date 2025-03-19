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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            // $table->string('applicantName', 200);
            // $table->string('myKadNo', 12)->unique();
            $table->integer('age');
            $table->string('race')->nullable();
            $table->string('nationality')->nullable();
            $table->string('birthState')->nullable();
            $table->string('gender')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->string('housePhone')->nullable();
            $table->string('mobilePhone')->nullable();
            $table->string('mailingAddress')->nullable();
            $table->string('mailingPostcode')->nullable();
            $table->string('mailingCity')->nullable();
            $table->string('mailingState')->nullable();
            $table->string('emergencyPhone')->nullable();
            $table->string('emergencyName')->nullable();
            $table->string('relationship')->nullable();
            $table->string('emergencyAddress')->nullable();
            $table->string('emergencyPostcode')->nullable();
            $table->string('emergencyCity')->nullable();
            $table->string('emergencyState')->nullable();
            $table->string('courseName')->nullable();
            $table->string('universityName')->nullable();
            $table->string('universityCountry')->nullable();
            $table->integer('commencementYear')->nullable();
            $table->integer('completionYear')->nullable();
            $table->string('result')->nullable();
            $table->text('personalStatement')->nullable();
            $table->text('skillsAndExtracurricular')->nullable();
            $table->string('employmentStatus')->nullable();
            $table->string('employerType')->nullable();
            $table->string('employerName')->nullable();
            $table->string('employerAddress')->nullable();
            $table->string('officePhone')->nullable();
            $table->string('position')->nullable();
            $table->decimal('salary', 10, 2)->nullable(); // Example for salary field
            $table->string('appliedCourseTitle')->nullable();
            $table->string('university')->nullable();
            $table->string('studyMode')->nullable();
            $table->date('startDate')->nullable();
            $table->date('dndDate')->nullable();
            $table->string('studyPeriod')->nullable(); // Assuming it's in months/years, adjust type as needed
            $table->text('researchProposalSummary')->nullable();
            $table->enum('status', ['draft', 'complete'])->default('draft');
            $table->foreignId('user_id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
