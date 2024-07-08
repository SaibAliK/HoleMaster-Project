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
        Schema::table('operatives', function (Blueprint $table) {
            $table->string('address1')->nullable()->change();
            $table->string('address2')->nullable()->change();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operatives', function (Blueprint $table) {
            $table->string('address1')->change();
            $table->string('address2')->change();

            
        });
    }
};
