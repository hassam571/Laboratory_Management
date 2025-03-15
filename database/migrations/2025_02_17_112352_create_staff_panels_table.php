<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('staff_panels', function (Blueprint $table) {
            // Custom primary key
            $table->bigIncrements('staffPanelId');

            // Foreign key to users table (assuming 'id' is primary key in users table)
            $table->unsignedBigInteger('userId');

            // Credits columns
            $table->decimal('credits', 8, 2)->default(0);
            $table->decimal('remainingCredits', 8, 2)->default(0);

            // Custom date column
            $table->date('createdDate')->nullable();

            // Optionally, Laravel's default timestamps
            $table->timestamps();

            // Foreign key constraint (optional but recommended)
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff_panels');
    }
};
