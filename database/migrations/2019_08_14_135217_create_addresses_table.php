<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('state');
            $table->string('district');
            $table->string('street');
            $table->string('postal_code');
            $table->timestamps();

            //references
            // teacher address
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')
                ->references('id')->on('teachers')
                ->onDelete('cascade');
            
            // group address
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')
                ->references('id')->on('groups')
                 ->onDelete('cascade');
            
            // simple session address            
            $table->unsignedBigInteger('simple_session_id')->nullable();
            $table->foreign('simple_session_id')
                ->references('id')->on('simple_sessions')
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
        Schema::dropIfExists('addresses');
    }
}
