<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('email',100);
            $table->string('phone',20);
            $table->string('mobile',20);
            $table->string('fax',50)->nullable();
            $table->string('website',150)->nullable();
            $table->string('company_name',150)->nullable();
            $table->enum('inquiry_type', ['General', 'Quatation']);	
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('master_countries')->onDelete('restrict');
            $table->string('address');
            $table->enum('status', ['active', 'inactive','deleted'])->default('active');
            $table->enum('lead_value', ['Hot', 'Warm','Medium','Cold'])->nullable();
            $table->string('zipcode',10);
            $table->text('comment')->nullable();
            $table->enum('quote_inquiry_status', ['Pending', 'Submitted','Estimating','Won','Lost'])->default('Pending');
            $table->enum('general_inquiry_status', ['Pending', 'Escalated','Solved'])->default('Pending');
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
        Schema::dropIfExists('inquiries');
    }
}
