<?php

use App\Models\Enterprise;
use App\Models\OfferSource;
use App\Models\OfferType;
use App\Models\User;
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
        Schema::create('offers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('description');
            $table->string('estimated_budget');
            $table->string('submission_date');
            $table->string('publication_date');
            $table->string('amount');
            $table->string('submission_deadline');
            $table->string('status');

            $table->foreignIdFor(OfferType::class);
            $table->foreignIdFor(OfferSource::class);
            $table->foreignIdFor(Enterprise::class);
            $table->foreignIdFor(User::class);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
