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
            $table->string('carrier')->nullable();
            $table->text('address')->nullable();
            $table->string('date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->longText('tractor_category')->nullable();
            $table->string('truck_no')->nullable();
            $table->string('odometer_reading')->nullable();
            $table->longText('trailer_category')->nullable();
            $table->string('trailer_no')->nullable();
            $table->string('remark')->nullable();
            $table->text('signature_image')->nullable();
            $table->boolean('satisfactory')->default(false);
            $table->boolean('corrected')->default(false);
            $table->boolean('not_corrected')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
