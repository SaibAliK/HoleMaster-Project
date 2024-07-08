<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_responses', function (Blueprint $table) {
            $table->id();
            $table->integer('job_detail_id');
            $table->integer('form_id');
            $table->integer('section_id');
            $table->integer('question_id');
            $table->string('question_type');
            $table->longText('answer')->nullable();
            $table->longText('option')->nullable();
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
        Schema::dropIfExists('save_responses');
    }
};
