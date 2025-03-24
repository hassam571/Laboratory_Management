<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
            Schema::create('customers', function (Blueprint $table) {
                $table->bigIncrements('customerId'); // Primary key
                $table->unsignedBigInteger('userId')->nullable(); // If referencing a users table
                $table->string('relation')->nullable();
                $table->string('title')->nullable();
                $table->string('user_name')->nullable();
                $table->string('name');
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('gender')->nullable();
                $table->integer('age')->nullable();
                $table->string('lcStatus')->nullable();    // E.g. life-cycle or lab-check status
                $table->unsignedBigInteger('extPanelId')->nullable();  // External panel ID if used
                $table->unsignedBigInteger('addRefrealId')->nullable(); // Additional referral ID if used
                $table->unsignedBigInteger('staffPanelId')->nullable(); // Staff panel reference
                $table->text('comment')->nullable();
                $table->decimal('testDiscount', 8, 2)->default(0); // If discount applies
                $table->string('password', 10)->default(Str::random(5)); // Auto-generate 5-character alphanumeric password
                $table->timestamps();

                // If you want default Laravel timestamps:
                // $table->timestamps(); // created_at, updated_at
            });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};