<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('itmId');
            $table->unsignedBigInteger('userId');
            $table->string('itemName');
            $table->text('itemDetail');
            $table->date('expDate');
            $table->integer('itmQnt');
            $table->integer('itmPrice');
            $table->date('createdDate');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
