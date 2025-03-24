<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('test_ranges', function (Blueprint $table) {
            $table->bigIncrements('testRangeId');
            $table->unsignedBigInteger('addTestId'); // Link to tests table

            // e.g. "Male", "Female", "Child"
            $table->string('testTypeName');
            $table->string('gender')->nullable(); // Added gender column
            $table->decimal('minRange', 8, 2)->nullable();
            $table->decimal('maxRange', 8, 2)->nullable();
            $table->string('unit')->nullable();

            $table->timestamps();

            // Optional foreign key constraint
            $table->foreign('addTestId')
                  ->references('addTestId')->on('tests')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_ranges');
    }
};
