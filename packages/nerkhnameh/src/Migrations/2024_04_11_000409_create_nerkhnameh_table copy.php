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
        Schema::create('nerkhnameh', function (Blueprint $table) {
            $table->id();
            $table->string('guild_name')->nullable();
            $table->string('fullname')->nullable();
            $table->string('national_id')->nullable();
            $table->string('mobile')->nullable();
            $table->string('tel')->nullable();
            $table->string('guild_number')->nullable();
            $table->text('address')->nullable();
            $table->string('personal_image_file')->nullable();
            $table->string('commitment_file')->nullable();
            $table->string('price')->nullable();
            $table->string('price_payment_file')->nullable();
            $table->tinyInteger('fin_validation')->nullable();
            $table->string('nerkhnameh_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nerkhnameh');
    }
};
