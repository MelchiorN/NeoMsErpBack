<?php

use App\Models\Article;
use App\Models\Order;
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
        Schema::create('article_order', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('quantity')->default(1);
            $table->timestamps();
            // // Relation avec Orders (UUID)
            // $table->uuid('order_id');
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            // // Relation avec Articles (UUID)
            // $table->uuid('article_id');
            // $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

            $table->foreignIdFor(Order::class);
            $table->foreignIdFor(Article::class);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_order');
    }
};
