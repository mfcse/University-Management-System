<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocate_classrooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->string('course_code');
            $table->string('room_code');
            $table->string('day');
            $table->timestamp('start_time')->default(Carbon::now());;
            $table->timestamp('end_time')->default(Carbon::now());;
            $table->tinyInteger('allocated')->default(1);
            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('course_code')->references('code')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('room_code')->references('code')->on('classrooms')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allocate_classrooms');
    }
}