<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('testreport', function (Blueprint $table) {
            $table->id('reportId');
            $table->unsignedBigInteger('ctId'); // Foreign key from customer_tests table
            $table->unsignedBigInteger('reporterId'); // Foreign key from users table
            $table->string('signStatus')->nullable();
            $table->timestamp('createdDate')->useCurrent();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('ctId')->references('ctId')->on('customer_tests')->onDelete('cascade');
            $table->foreign('reporterId')->references('id')->on('users')->onDelete('cascade'); // Linking to users table
        });
    }

    public function down()
    {
        Schema::dropIfExists('testreport');
    }
};
