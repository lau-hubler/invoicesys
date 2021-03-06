<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('vendor_id');
            $table->date('invoice_date');
            $table->date('delivery_date')->nullable();
            $table->date('due_date');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('client_id')->references('id')->on('companies');
            $table->foreign('vendor_id')->references('id')->on('companies');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
