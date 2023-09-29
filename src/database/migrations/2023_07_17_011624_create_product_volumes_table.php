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
        Schema::create('product_volumes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('line_id')->comment('LineマスタID');
            $table->unsignedBigInteger('product_id')->comment('製品マスタID');
            $table->integer('count_volume');
            $table->integer('count_worker');
            $table->dateTime('work_start_at')->comment('製品日時。9:00');;
            $table->dateTime('work_end_at')->comment('製品日時。9:59');;
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('product_volumes', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_volumes');
    }
};
