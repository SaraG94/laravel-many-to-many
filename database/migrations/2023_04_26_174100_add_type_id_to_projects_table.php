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
        Schema::table('projects', function (Blueprint $table) {
            //aggiungo la colonna
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
            //creando la relazione 
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //elimino la realzione
            $table->dropForeign(['type_id']);
            //elimino la colonna
            $table->dropColumn('type_id');
        });
    }
};
