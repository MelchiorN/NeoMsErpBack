<?php

use App\Models\Project;
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
        Schema::create('project_steps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('label');
            $table->string('estimated_start_date');
            $table->string('actual_start_date')->nullable();
            $table->string('estimated_end_date');
            $table->string('actual_end_date')->nullable();
            $table->string('comment')->nullable();
            $table->string('status');
            $table->foreignIdFor(Project::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_steps');
    }
};
