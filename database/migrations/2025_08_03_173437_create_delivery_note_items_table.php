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
        Schema::create('delivery_note_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('delivery_note_id');
            $table->foreign('delivery_note_id')->references('id')->on('delivery_notes')->onDelete('cascade');
            $table->uuid('article_id'); // <- ajoute la colonne article_id
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade'); 
            $table->string('product_code');   // code produit (dupliqué pour historique)
            $table->string('designation')->nullable();;    // nom ou description produit
            $table->string('serial_number')->nullable();
            $table->integer('quantity_ordered');   // commandée (pour référence)
            $table->integer('quantity_delivered'); // quantité livrée dans ce bordereau
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_note_items');
    }
};
