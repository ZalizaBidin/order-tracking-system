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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->unique();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('shopper_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('item_name');
            $table->text('item_description')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('estimated_budget', 10, 2)->nullable();

            $table->enum('status', [
                'Pending',
                'Accepted',
                'Shopping in Progress',
                'Purchased',
                'Out for Delivery',
                'Completed',
                'Cancelled'
            ])->default('Pending');

            $table->text('remarks')->nullable();

            // Extra feature: GPS tracking
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();
        });
    }
};
