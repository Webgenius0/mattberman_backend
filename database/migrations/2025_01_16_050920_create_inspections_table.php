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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('carrier');
            $table->text('address');
            $table->string('date');
            $table->integer('start_time');
            $table->integer('end_time');
            $table->string('tractor_category');
            $table->integer('truck_no');
            $table->string('odometer_reading');
            $table->string('trailer_category');
            $table->integer('trailer_no');
            $table->string('remark');
            $table->text('signature_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
