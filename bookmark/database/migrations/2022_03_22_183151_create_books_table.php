<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); # `id` primary key, auto-incrementing
            $table->timestamps(); # `created_at`, `updated_at`
            $table->string('slug'); # VARCHAR
            $table->string('title'); # VARCHAR
            $table->string('author'); # VARCHAR
            $table->smallInteger('published_year'); # SMALLINT
            $table->string('cover_url')->nullable(); # VARCHAR
            $table->string('info_url'); # VARCHAR
            $table->string('purchase_url'); # VARCHAR
            $table->text('description'); # TEXT
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
