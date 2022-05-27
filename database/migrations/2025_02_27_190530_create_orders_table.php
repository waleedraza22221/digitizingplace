<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->float('budget')->default(0.00);
            $table->enum('status', ['Quote', 'Awaiting Payments', 'New', 'In Process', 'In Revision', 'Completed']);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->dateTime('duedate')->nullable();
            $table->dateTime('completed_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
