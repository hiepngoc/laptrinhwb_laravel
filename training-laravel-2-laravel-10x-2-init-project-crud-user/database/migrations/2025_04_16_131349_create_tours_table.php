<?php

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
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('tour_id');
            $table->string('tour_name');
            $table->string('tour_image')->nullable();
            $table->date('start_day');
            $table->string('time');
            $table->string('star_from')->nullable();
            $table->decimal('price', 10, 0);
            $table->string('vehicle')->nullable();
            $table->text('tour_description')->nullable();
            $table->text('tour_schedule')->nullable();
            $table->string('tour_sale')->nullable();
            $table->integer('total_seats')->default(0);
            $table->integer('booked_seats')->default(0);
            $table->unsignedInteger('location_id');
            $table->unsignedBigInteger('guide_id'); // ĐÃ SỬA: Sử dụng unsignedBigInteger
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('guide_id')->references('guide_Id')->on('guides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
};