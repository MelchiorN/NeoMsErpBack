<?php

use App\Models\Equipement;
use App\Models\Failure;
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
        Schema::create('equipement_failure', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignIdFor(Equipement::class);
            $table->foreignIdFor(Failure::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipement_failure');
    }
};
