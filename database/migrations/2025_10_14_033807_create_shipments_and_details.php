<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('ship_no')->unique();
            $table->foreignId('warehouse_id')->constrained('warehouses');
            $table->date('date');
            $table->string('destination')->nullable();
            $table->unsignedBigInteger('operator_id')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('shipment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained('shipments')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('shipment_details');
        Schema::dropIfExists('shipments');
    }
};