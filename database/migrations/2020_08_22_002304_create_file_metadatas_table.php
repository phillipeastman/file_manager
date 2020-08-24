<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileMetadatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_metadatas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('original_filename');
            $table->string('path')->unique();
            $table->string('file_type');
            $table->string('tags');
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
        Schema::dropIfExists('file_metadatas');
    }
}
