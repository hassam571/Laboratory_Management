<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('credit', function (Blueprint $table) {
            $table->id('creditAi'); // Primary Key
            $table->unsignedBigInteger('userId'); // Foreign Key for users
            $table->decimal('creditAmount', 10, 2);
            $table->text('creditDetail')->nullable();
            $table->date('createdDate');
            $table->timestamps();

            // Foreign key constraint (Assuming users table exists)
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('credit');
    }
};
