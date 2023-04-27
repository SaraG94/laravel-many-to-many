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
        Schema::create('project_technology', function (Blueprint $table) {
           //creo la colonna project_id
            $table->unsignedBigInteger('project_id');
            //definisco la chiave esterna
            $table->foreign('project_id')->references('id')->on('projects');

            //creo la colonna technology_id
            $table->unsignedBigInteger('technology_id');
            //definisco la chiave esterna
            $table->foreign('technology_id')->references('id')->on('technologies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_technology');
        //quando viene eliminata la tabella vengono eliminate le relazioni
    }
};
