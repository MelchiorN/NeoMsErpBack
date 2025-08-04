<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('failures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('date');
            $table->text('description')->nullable();

            $table->foreignIdFor(User::class)->comment("Clé pour accéder rapidement à l'utilisateur qui a fait l'opération");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failures');
    }
};
