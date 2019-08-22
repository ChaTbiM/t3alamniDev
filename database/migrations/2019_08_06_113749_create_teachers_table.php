<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            // auth info
            $table->string('user_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('age')->nullable();
            $table->string('experience')->nullable();
            
            //personal info
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_teach')->nullable();


            $table->integer('note')->nullable();  // probably make notes table and reference it
            
            // references
            // $table->unsignedBigInteger('address_id');
            // $table->unsignedBigInteger('diploma_id'); done
            // $table->unsignedBigInteger('cv_id'); done
            
            
            // $table->foreign('address_id')
            //     ->references('id')
            //     ->on('addresses');
                
            // $table->foreign('diploma_id')
            //     ->references('id')
            //     ->on('diplomas');
                

            // $table->foreign('cv_id')
            //     ->references('id')
            //     ->on('c_v_s');
                

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
