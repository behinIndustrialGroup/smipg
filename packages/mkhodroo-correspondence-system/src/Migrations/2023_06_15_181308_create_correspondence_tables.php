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
        Schema::create('correspondence_numbering_formats', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('format')->nullable();
            $table->string('start_from')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('correspondence_letters', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('tags')->nullable();
            $table->string('number')->nullable();
            $table->string('date')->nullable();
            $table->binary('file')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('correspondence_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('correspondence_user_role', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->bigInteger('role_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('correspondence_roles');
        });
        Schema::create('correspondence_templates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('numbering_format_id')->unsigned();
            $table->string('name');
            $table->binary('file')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('numbering_format_id')->references('id')->on('correspondence_numbering_formats');
        });
        Schema::create('correspondence_template_access', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('template_id')->unsigned();
            $table->bigInteger('role_id')->unsigned();
            $table->tinyInteger('create')->default(0);
            $table->tinyInteger('numbering')->default(0);
            $table->tinyInteger('signing')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('template_id')->references('id')->on('correspondence_templates');
            $table->foreign('role_id')->references('id')->on('correspondence_roles');
        });
        Schema::create('correspondence_letter_attachments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('letter_id')->unsigned();
            $table->string('name')->nullable();
            $table->binary('file');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('letter_id')->references('id')->on('correspondence_letters');
        });
        Schema::create('correspondence_letter_receivers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('letter_id')->unsigned();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('letter_id')->references('id')->on('correspondence_letters');
        });
        Schema::create('correspondence_letter_body', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('letter_id')->unsigned();
            $table->text('content')->nullable();
            $table->binary('file');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('letter_id')->references('id')->on('correspondence_letters');
        });
        Schema::create('correspondence_letter_activities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('letter_id')->unsigned();
            $table->integer('user_id')->nullable();
            $table->string('action')->nullable();
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
        Schema::dropIfExists('mkhodroo_access');
        Schema::dropIfExists('mkhodroo_methods');
        Schema::dropIfExists('mkhodroo_roles');
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('role_id');
        });
    }
};
