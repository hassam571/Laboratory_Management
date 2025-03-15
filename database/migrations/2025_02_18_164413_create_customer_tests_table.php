<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_tests', function (Blueprint $table) {
            $table->bigIncrements('ctId'); // Primary key

            // Link to your tests table if you have one
            // "addTestId" references the "tests" table's primary key
            $table->unsignedBigInteger('addTestId');

            // Link to customers table
            $table->unsignedBigInteger('customerId');

            $table->dateTime('createdDate')->nullable(); // or $table->timestamps()
            $table->string('testStatus')->nullable(); // e.g. "pending", "collected"
            $table->dateTime('reportDate')->nullable();
            $table->timestamps();
            // Optionally define foreign keys if desired:
            // $table->foreign('customerId')
            //       ->references('customerId')->on('customers')
            //       ->onDelete('cascade');
            // $table->foreign('addTestId')
            //       ->references('addTestId')->on('tests')
            //       ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_tests');
    }
};
