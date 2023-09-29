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
        Schema::create('line_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('line_id')->comment('LINEマスタID');
            $table->unsignedBigInteger('product_id')->comment('製品マスタID');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('line_products', function (Blueprint $table) {
            $table->foreign('line_id')
                ->references('id')
                ->on('lines')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');

            $table->unique([
                'line_id',
                'product_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_products');
    }
};
