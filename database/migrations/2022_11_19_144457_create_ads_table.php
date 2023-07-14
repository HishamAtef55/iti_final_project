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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('category_id');
            $table->foreignId('user_id');
            $table->float('price');
            $table->enum('status', ['Approved', 'Pending', 'Sold', 'Deactive','Rejected' , 'Update Pending' , 'Expired'])->default('pending');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('remaining')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('country_id');
            $table->foreignId('city_id');
            $table->string('location')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
};
