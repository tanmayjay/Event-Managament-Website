<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('type');
            $table->string('location');
            $table->string('performer');
            $table->string('organizer');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->unsignedBigInteger('ticket_price')->default(0);
            $table->unsignedBigInteger('capacity')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
