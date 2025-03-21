<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('external_panels', function (Blueprint $table) {
            $table->bigIncrements('extPanelId');
            $table->string('panelName');
            $table->string('panelAddrs')->nullable();
            $table->decimal('credits', 8, 2)->default(0);            // Total Credits
            $table->decimal('remainingCredits', 8, 2)->default(0);      // Remaining Credits
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('external_panels');
    }
};
