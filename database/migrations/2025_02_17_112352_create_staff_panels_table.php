<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('staff_panels', function (Blueprint $table) {
            $table->bigIncrements('staffPanelId');
            $table->unsignedBigInteger('userId');
            $table->decimal('credits', 8, 2)->default(0);
            $table->decimal('remainingCredits', 8, 2)->default(0);
            $table->date('createdDate')->nullable();
            $table->timestamps();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff_panels');
    }
};
