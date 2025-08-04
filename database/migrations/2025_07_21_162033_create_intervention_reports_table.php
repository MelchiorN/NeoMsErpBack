<?php

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervention_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('diagnosis');
            $table->text('performed_test');
            $table->string('address');
            $table->timestamp('date');
            $table->text('done_work');

            $table->foreignIdFor(Client::class);
            $table->foreignIdFor(User::class);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intervention_reports');
    }
};
