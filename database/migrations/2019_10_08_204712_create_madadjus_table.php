<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMadadjusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('madadjus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('operator_id')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('national_code')->nullable();
            $table->string('support_type')->nullable();
            $table->string('disabilty_type')->nullable();
            $table->string('disabilty_level')->nullable();
            $table->boolean('male')->nullable();
            $table->string('education_grade')->nullable();
            $table->string('education_field')->nullable();
            $table->string('education_subfield')->nullable();
            $table->string('disability_type')->nullable();
            $table->string('disability_level')->nullable();
            $table->text('address')->nullable();
            $table->string('mobile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('madadjus');
    }
}
