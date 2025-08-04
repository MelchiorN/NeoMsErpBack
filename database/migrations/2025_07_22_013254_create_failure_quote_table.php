<?php

use App\Models\Failure;
use App\Models\Quote;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('failure_quote', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignIdFor(Failure::class);
            $table->foreignIdFor(Quote::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failure_quote');
    }
};
