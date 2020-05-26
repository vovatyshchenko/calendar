<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('birthdays_active');
            $table->boolean('tasks_active');
            $table->boolean('activities_active');
            $table->boolean('holidays_active');
            $table->unsignedInteger('birthdays_color');
            $table->unsignedInteger('tasks_color');
            $table->unsignedInteger('activities_color');
            $table->unsignedInteger('holidays_color');
            $table->timestamps();
        });

        Schema::table('type_colors', function (Blueprint $table) {
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
        Schema::dropIfExists('type_colors');
    }
}
