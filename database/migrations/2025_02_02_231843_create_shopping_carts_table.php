<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id();                       //CartID
            $table->foreignIdFor(User::class)   // UserID
                    ->nullable()
                    ->constrained()
                    ->onDelete('cascade');
            $table->enum('status', ['active', 'checking_out', 'checked_out', 'abandoned']);
            $table->boolean('wrap')->default(false);
            $table->timestamps();   //OrderDate (created_at), LastUpdate (updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_carts');
    }
};
