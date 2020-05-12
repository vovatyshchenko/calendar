<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirthdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birthdays', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('description',150);
            $table->unsignedBigInteger('user_id');
            $table->string('time',10);
            $table->boolean('allDay')->default(0);
            $table->boolean('allYear')->default(0);
            $table->timestamp('date');
            $table->timestamps();
        });

        Schema::table('birthdays', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('birthdays');
    }
}
