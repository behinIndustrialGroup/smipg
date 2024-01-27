<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correspondence_inbox', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('letter_id')->unsigned();
            $table->integer('user_id')->nullable();
            $table->string('status')->nullable();
            $table->string('for')->nullable();
            $table->string('done_date', '20')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('letter_id')->references('id')->on('correspondence_letters');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
