<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDeliveryTrucksTable extends Migration {
    public function up() {
        Schema::create('delivery_trucks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('license_plate')->unique();
            $table->string('model');
            $table->string('driver_name');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('delivery_trucks');
    }
}
