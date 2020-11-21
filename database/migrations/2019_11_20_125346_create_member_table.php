<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('added_id')->length(11)->unsigned();
            $table->foreign('added_id')->references('id')->on('admin')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('year');
            $table->string('account_code',250);
            $table->string('name',250);
            $table->string('name_bangla',250);
            $table->string('father_name',250);
            $table->string('mother_name',250);
            $table->string('nid_number',250);
            $table->date('dob',250);
            $table->integer('age');
            $table->tinyInteger('gender')->comment('1 = Male 2 = Female 3 = Others');
            $table->string('religion',250);
            $table->string('occupation',250);
            $table->mediumText('present_address');
            $table->mediumText('permanent_address');
            $table->string('married_status',250);
            $table->decimal('annual_income',40,2);
            $table->string('health_condition',250);
            $table->string('financial_condition',250);
            $table->string('social_status',250);
            $table->string('identification_mark',250);
            $table->string('nominee_name',250);
            $table->mediumText('nominee_address');
            $table->string('relationship_with_allowance',250);
            $table->string('member_photo',250);
            $table->string('nominee_photo',250);
            $table->tinyInteger('status')->comment('0 = Pending 1 = Primary Selection 2 = Final Selection 3 = Dead 4 = Others');
            $table->date('created_at');
            $table->time('created_time');
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
        Schema::drop('member');
    }
}
