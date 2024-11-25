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
        // Schema::create('marketing_cards', function (Blueprint $table) {
        //     $table->uuid('id')->primary();
        //     $table->string('firstName');
        //     $table->string('lastName');
        //     $table->string('nationalId');
        //     $table->string('fatherName');
        //     $table->string('issueDate');
        //     $table->string('expiryDate');
        //     $table->string('qrCodeFilePath');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_cards');
    }
};
