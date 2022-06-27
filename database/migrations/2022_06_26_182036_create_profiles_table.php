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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('BMW_model')->nullable();
            $table->string('body_type')->nullable();
            $table->char('year', 4)->nullable();
            $table->string('engine')->nullable();
            $table->smallInteger('power')->nullable();
            $table->longText('description')->nullable();
            $table->string('image_path')->default('default_img.jpg');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
