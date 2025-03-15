<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('external_panels', function (Blueprint $table) {
            // If you want a custom primary key name:
            $table->bigIncrements('extPanelId'); // primary key
            $table->string('panelName');
            $table->string('panelAddrs')->nullable();
            $table->text('panelDes')->nullable();

            // If you want a separate 'createdDate' column, you can do:
            // $table->date('createdDate')->nullable();

            // Laravel's built-in created_at and updated_at
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('external_panels');
    }
};
