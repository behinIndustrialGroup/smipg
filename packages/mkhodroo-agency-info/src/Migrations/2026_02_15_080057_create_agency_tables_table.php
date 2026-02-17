<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();

            $table->string('file_number')->nullable()->index();
            $table->string('guild_category_slug')->nullable()->index();
            $table->string('category_type')->nullable();
            $table->string('person_type')->nullable();
            $table->string('file_type')->nullable();

            $table->string('status')->nullable();
            $table->string('new_status')->nullable()->index();
            $table->string('last_referral')->nullable()->index();

            $table->text('description')->nullable();

            $table->foreignId('province_id')->nullable()->constrained('provinces')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('agency_people', function (Blueprint $table) {
            $table->id();

            $table->foreignId('agency_id')
                ->constrained('agencies')
                ->cascadeOnDelete();

            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('national_id', 20)->nullable()->index();
            $table->string('mobile', 20)->nullable()->index();
            $table->string('phone', 20)->nullable();

            $table->string('guild_number')->nullable();
            $table->string('issued_date')->nullable();
            $table->string('exp_date')->nullable();
            $table->string('guild_or_legal_name')->nullable();

            

            $table->timestamps();
        });


        Schema::create('agency_memberships', function (Blueprint $table) {
            $table->id();

            $table->foreignId('agency_id')
                ->constrained('agencies')
                ->cascadeOnDelete();

            $table->string('title')->index();
            $table->string('type')->index(); // membership | donate | sodur

            $table->decimal('amount', 15, 2)->nullable();
            $table->date('pay_date')->nullable();
            $table->string('ref_id')->nullable()->index();
            $table->string('file_path')->nullable();

            $table->timestamps();
        });

        Schema::create('agency_debts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('agency_id')
                ->constrained('agencies')
                ->cascadeOnDelete();

            $table->string('title')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->date('pay_date')->nullable();
            $table->string('ref_id')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });

        Schema::create('agency_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('agency_id')
                ->constrained('agencies')
                ->cascadeOnDelete();

            $table->string('type')->index(); // national_card, tax, etc
            $table->string('file_path');

            $table->timestamps();
        });

        Schema::create('agency_foremen', function (Blueprint $table) {
            $table->id();

            $table->foreignId('agency_id')
                ->constrained('agencies')
                ->cascadeOnDelete();

            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('national_id', 20)->nullable();
            $table->string('mobile', 20)->nullable();

            $table->timestamps();
        });

        Schema::create('agency_foreman_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('foreman_id')
                ->constrained('agency_foremen')
                ->cascadeOnDelete();

            $table->string('type')->index();
            $table->string('file_path');

            $table->timestamps();
        });

        Schema::create('agency_inspections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('agency_id')
                ->constrained('agencies')
                ->cascadeOnDelete();

            $table->string('inspection_number');
            $table->string('name')->nullable();
            $table->string('file_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_info');
    }
};
