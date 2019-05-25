<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadDirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_directories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('directory_name');
            $table->integer('inquiry_id')->unsigned();
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
            $table->enum('status', ['active', 'inactive','deleted'])->default('active');
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
        Schema::dropIfExists('upload_directories');
    }
}
