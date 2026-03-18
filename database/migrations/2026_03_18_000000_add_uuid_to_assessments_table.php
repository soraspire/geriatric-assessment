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
        Schema::table('assessments', function (Blueprint $table) {
            $table->uuid('uuid')->after('id')->nullable();
        });

        // Populate existing records with UUIDs
        $assessments = \App\Models\Assessment::whereNull('uuid')->get();
        foreach ($assessments as $assessment) {
            $assessment->uuid = (string) \Illuminate\Support\Str::uuid();
            $assessment->save();
        }

        Schema::table('assessments', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
