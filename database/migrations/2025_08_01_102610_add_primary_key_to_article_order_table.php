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
        Schema::table('article_order', function (Blueprint $table) {
             $table->dropPrimary();
             if (Schema::hasColumn('article_order', 'id')) {
                $table->dropColumn('id');
             }
             $table->primary(['order_id', 'article_id']);
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_order', function (Blueprint $table) {
        
             // Supprimer la clé primaire composite
            $table->dropPrimary(['order_id', 'article_id']);

            // Ajouter la colonne id à nouveau
            $table->uuid('id')->primary()->first();
            //
        });
    }
};
