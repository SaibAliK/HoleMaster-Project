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
        Schema::create('job_detail_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_detail_id')->constrained('job_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('job_detail_forms');
    }
};
