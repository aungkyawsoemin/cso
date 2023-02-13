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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id');
            $table->integer('sort_order');
            $table->integer('status')->default(0); //show, hide
            $table->integer('score')->default(1);
            $table->string('title');
            $table->string('correct_description');
            $table->integer('type'); // single, multiple, dropdown, range
            $table->string('thumbnail_url')->nullable();
            $table->integer('user_answer_count')->default(0);
            $table->integer('user_reach_count')->default(0);
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
