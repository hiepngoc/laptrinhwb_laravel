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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');  
            $table->text('description')->nullable();  
            $table->decimal('price', 10, 2); 
            $table->integer('quantity')->default(0);  
            $table->enum('status', ['active', 'inactive'])->default('active');  // Trạng thái sản phẩm
            $table->timestamps();  // Các trường created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
