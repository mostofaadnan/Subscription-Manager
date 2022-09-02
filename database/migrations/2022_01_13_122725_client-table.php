<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->length(700);
            $table->string('full_name')->length(300)->nullable();
            $table->string('instance_name')->length(300);
            $table->string('email')->length(200)->unique();
            $table->integer('phone')->length(14);
            $table->text('address')->length(5000)->nullable();
            $table->string('city')->length(700);
            $table->integer('post_code')->length(11)->nullable();
            $table->string('tax_number')->length(225)->nullable();
            $table->text('billing_startdate')->nullable();
            $table->integer('client_status')->length(11)->default('1')->comment('0 means unactive');
            $table->text('user_domain')->nullable();
            $table->float('fleet_rate')->default();
            $table->float('fleet_qty')->default(1);
            $table->tinyInteger('new_request')->default(0);
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
        //
    }
}
