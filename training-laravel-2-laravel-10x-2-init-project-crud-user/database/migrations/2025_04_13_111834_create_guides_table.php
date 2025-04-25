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
        Schema::create('guides', function (Blueprint $table) {
            $table->id('guide_Id'); // Sử dụng id('guide_Id') cho khóa chính tự tăng BIGINT có tên 'guide_Id'
            $table->string('guide_Name');
            $table->string('guide_Pno');
            $table->string('guide_Img')->nullable(); // Cho phép null
            $table->string('guide_Mail')->nullable(); // Cho phép null
            $table->text('guide_Intro')->nullable(); // Cho phép null
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
        Schema::dropIfExists('guides');
    }
};