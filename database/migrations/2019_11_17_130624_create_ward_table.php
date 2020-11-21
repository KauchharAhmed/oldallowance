<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ward', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('union_id')->length(11)->unsigned();
            $table->foreign('union_id')->references('id')->on('union_paurashava')->onDelete('restrict')->onUpdate('cascade');
            $table->string('w_name',250);
            $table->string('wb_name',250);
            $table->tinyInteger('status')->comment('1 = Active 2 = No Active');
            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ward');
    }
}
