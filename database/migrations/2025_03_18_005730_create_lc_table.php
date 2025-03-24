<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLcTable extends Migration
{
    public function up()
    {
        Schema::create('lc', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->json('customer_ids');  // This matches your model
            $table->decimal('percentage', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lc');
    }
}