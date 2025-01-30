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
            $table->id();                   //ProductID
            $table->string('name');         //ProductName
            $table->string('slug')->unique();
            $table->string('brand');
            $table->decimal('price',5,2)
                ->unsigned()
                ->default(0);
            $table->string('description')->nullable();  //ProductDescription
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
