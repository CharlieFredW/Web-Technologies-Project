<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // This will create an auto-incrementing primary key column called "id"
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('user_id')->nullable(); // Assuming user_id is the foreign key
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
