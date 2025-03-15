<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('payId'); // Primary key

            // Link to customers table
            $table->unsignedBigInteger('customerId');

            // Payment columns
            $table->decimal('recieved', 8, 2)->default(0);
            $table->decimal('pending', 8, 2)->default(0);
            $table->dateTime('createdDate')->nullable(); // or $table->timestamps()

            // Optionally define foreign key:
            // $table->foreign('customerId')
            //       ->references('customerId')->on('customers')
            //       ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
