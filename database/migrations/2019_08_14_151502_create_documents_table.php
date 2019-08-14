<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('url');
            $table->timestamps();

            //references
            // fixed session documents            
            $table->unsignedBigInteger('fixed_session_id')->nullable();
            $table->foreign('fixed_session_id')
                ->references('id')->on('fixed_sessions')
                ->onDelete('cascade');

            // simple session documents            
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
        Schema::dropIfExists('documents');
    }
}
