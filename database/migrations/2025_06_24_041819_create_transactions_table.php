
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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id');
        $table->unsignedBigInteger('branch_id');
        $table->unsignedBigInteger('district_id');
        $table->unsignedBigInteger('shipping_id');
        $table->string('invoice');
        $table->text('address');
        $table->decimal('total', 8, 2);
        $table->enum('status', ['pending', 'success', 'expired', 'failed'])->default('pending');
        $table->string('snap_token')->nullable();
        $table->timestamps();

        $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

