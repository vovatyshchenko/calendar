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
            $table->string('birthdays_color',10);
            $table->string('tasks_color',10);
            $table->string('activities_color',10);
            $table->string('holidays_color',10);
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
        Schema::dropIfExists('type_colors');
    }
}
