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
        Schema::table('marketing_cards', function (Blueprint $table) {
            $table->string('bornDate')->after('fatherName');
            $table->string('guildUnit')->after('bornDate');
            $table->string('guildNumber')->after('guildUnit');
            $table->string('province')->after('guildNumber');
            $table->string('city')->after('province');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_cards');
    }
};
