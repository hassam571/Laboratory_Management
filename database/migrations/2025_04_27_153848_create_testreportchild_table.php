

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('testreportchild', function (Blueprint $table) {
            $table->id('reportChildId');
            $table->unsignedBigInteger('reportId'); // Foreign key from testreport table
            $table->unsignedBigInteger('testRangeId'); // Foreign key from test_ranges table
            $table->string('reportValue');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('reportId')->references('reportId')->on('testreport')->onDelete('cascade');
            $table->foreign('testRangeId')->references('testRangeId')->on('test_ranges')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('testreportchild');
    }
};
