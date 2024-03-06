<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_members', function (Blueprint $table) {
            $table->id('mid');
            $table->foreignId('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->integer('member_id')->default(12);
            $table->foreignId('Tour_id')->references('tid')->on('tour')->onDelete('cascade');
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
        Schema::dropIfExists('tour_members');
    }
}
