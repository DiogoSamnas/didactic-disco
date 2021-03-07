<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("notes_id");
            $table->foreign("notes_id")->references("id")->on("notes");
            $table->unsignedBigInteger("tags_id");
            $table->foreign("tags_id")->references("id")->on("tags");
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
        Schema::dropIfExists('tags_notes');
    }
}
