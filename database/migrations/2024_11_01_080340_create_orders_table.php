<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateOrdersTable extends Migration {
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('fuel_amount', 8, 2);
            $table->string('delivery_address');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'completed', 'canceled']);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
}
