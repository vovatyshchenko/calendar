<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('guests')->nullable();
            $table->string('location')->nullable();
            $table->string('description');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('time_start',10);
            $table->string('time_end',10);
            $table->timestamp('date_start')->nullable();;
            $table->timestamp('date_end')->nullable();
            $table->timestamps();
        });

        Schema::table('activities', function (Blueprint $table) {
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
        Schema::dropIfExists('activities');
    }
}
