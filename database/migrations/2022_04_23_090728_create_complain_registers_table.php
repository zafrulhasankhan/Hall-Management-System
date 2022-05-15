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
        Schema::create('complain_registers', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('user_mail');
            $table->string('approval');
            $table->string('hall_name');
            $table->string('dept_name')->nullable();
            $table->string('student_ID')->nullable(); 
            $table->string('roomno')->nullable(); 
            $table->string('session')->nullable();
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
        Schema::dropIfExists('complain_registers');
    }
};
