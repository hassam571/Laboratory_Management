<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('test_categories', function (Blueprint $table) {
            // Custom primary key
            $table->bigIncrements('testCatId');

            // Foreign key to admins table (if you have one) or users table
            $table->unsignedBigInteger('adminId')->nullable();

            // Category name
            $table->string('testCat');

            // Category detail
            $table->text('catDetail')->nullable();

            // Timestamps
            $table->timestamps();

            // Example foreign key constraint (adjust if you have an 'admins' or 'users' table)
            // $table->foreign('adminId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_categories');
    }
};
