<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->integer('workout_plan_id');
            $table->string('member_type');
            $table->string('workout_name');
            $table->integer('time');
            $table->string('gender_type');
            $table->string('calories');
            $table->string('workout_level');
            $table->string('workout_periods');
            $table->string('place');
            $table->string('day');
            $table->string('image');
            $table->string('video');
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
        Schema::dropIfExists('workouts');
    }
}
