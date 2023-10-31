<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->string('title')->notNull();
            $table->string('url')->notNull();
            $table->unsignedBigInteger('owner')->notNull();
            $table->integer('total_downloads')->default(0);
            $table->text('description')->nullable();
            $table->integer('bpm')->nullable();
            $table->string('key')->nullable();
            $table->string('genre')->nullable();
            $table->string('instrument')->nullable();
            $table->string('image_url')->nullable();

            // Users.id is a foreign key for 'owner'
            $table->foreign('owner')->references('id')->on('users');

            $table->timestamps(); // created and updated timestamps
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('samples');
    }




};
