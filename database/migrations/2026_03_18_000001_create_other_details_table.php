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
        Schema::create('other_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->boolean('has_drug_allergy')->default(false);
            $table->string('drug_allergy_detail')->nullable();
            $table->boolean('has_sensory_impairment')->default(false);
            $table->boolean('has_incontinence')->default(false);
            $table->boolean('has_pressure_ulcer_risk')->default(false);
            $table->boolean('has_caregiver')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_details');
    }
};
