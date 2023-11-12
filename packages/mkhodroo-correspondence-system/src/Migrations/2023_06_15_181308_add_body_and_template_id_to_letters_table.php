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
        Schema::table('correspondence_letters', function (Blueprint $table) {
            $table->text('body')->nullable()->after('title');
            $table->bigInteger('template_id')->unsigned()->nullable()->after('id');
            $table->foreign('template_id')->references('id')->on('correspondence_templates');
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
