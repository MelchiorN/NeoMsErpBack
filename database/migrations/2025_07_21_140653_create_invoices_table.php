<?php

use App\Models\Client;
use App\Models\InvoiceType;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ref'); 
            $table->timestamp('date');
            $table->decimal('total', 15, 2);
            $table->integer('count_payment');

            $table->foreignIdFor(InvoiceType::class);
            $table->foreignIdFor(Order::class);
            $table
                ->foreignIdFor(User::class)
                ->comment("Clé pour accéder rapidement à l'utilisateur qui a fait l'opération");
            $table->foreignIdFor(Client::class)->comment('Clé pour accéder rapidement au client');

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
        Schema::dropIfExists('invoices');
    }
};
