<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('addTestId');

            // Test Name
            $table->string('testName');

            // Foreign key to test_categories table (if you want to reference it)
            $table->unsignedBigInteger('testCatId')->nullable();

            // Cost of the test
            $table->decimal('testCost', 8, 2)->default(0);

            // How to take the sample
            $table->text('howSample')->nullable();

            // Type of sample (blood, urine, etc.)
            $table->string('typeSample')->nullable();

            // Laravel timestamps
            $table->timestamps();

            // Optional foreign key constraint:
            // $table->foreign('testCatId')
            //       ->references('testCatId')->on('test_categories')
            //       ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tests');
    }
};
