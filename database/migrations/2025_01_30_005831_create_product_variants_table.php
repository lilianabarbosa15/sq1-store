<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();                           //VariantID
            $table->foreignIdFor(Product::class)    //ProductID
                ->constrained()
                ->onDelete('cascade');
            $table->string('color_name', 20);        //
            $table->string('color', 7);             //#RRGGBB
            $table->decimal('sale_price',5,2)
                ->unsigned()
                ->nullable();
            $table->timestamp('sale_end_time')
                ->nullable();
            $table->integer('rating')->default(0);
            $table->json('quantity');               //{ size1:stock1, size2:stock2 }    $table->json('sizes')->nullable();  $table->integer('stock');
            $table->json('images');
            $table->integer('review_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
