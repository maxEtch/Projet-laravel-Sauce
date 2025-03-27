<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaucesTable extends Migration
{
    public function up()
    {
        Schema::create('sauces', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('name');
            $table->string('manufacturer');
            $table->text('description');
            $table->string('mainPepper');
            $table->string('imageUrl');
            $table->integer('heat');
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->text('usersLiked')->nullable(); // Utilisez text au lieu de json
            $table->text('usersDisliked')->nullable(); // Utilisez text au lieu de json
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sauces');
    }
}