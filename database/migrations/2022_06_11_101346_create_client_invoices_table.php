<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_invoices', function (Blueprint $table) {
            $table->id();
            $table->text('invoice_number');
            $table->text('invoice_date');
            $table->unsignedBigInteger('client_id');
            $table->float('client_rate');
            $table->float('client_qty');
            $table->float('client_amount');
            $table->float('driver_rate');
            $table->float('driver_qty');
            $table->float('driver_amount');
            $table->float('total_amount');
            $table->float('total_vat');
            $table->float('nettotal');
            $table->tinyInteger('payment_status')->default(0);
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
        Schema::dropIfExists('client_invoices');
    }
}