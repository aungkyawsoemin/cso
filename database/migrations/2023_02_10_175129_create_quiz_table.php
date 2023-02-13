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
        Schema::create('quiz', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description');
            $table->json('options')->nullable();
            $table->integer('question_count')->default(0);
            $table->integer('user_answer_count')->default(0);
            $table->integer('status')->default(0); //show, hide
            $table->integer('level')->default(0); //easy, normal, hard
            $table->string('thumbnail_url')->nullable();
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
        Schema::dropIfExists('quiz');
    }
};
