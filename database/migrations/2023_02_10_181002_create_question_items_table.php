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
        Schema::create('question_items', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id');
            $table->integer('sort_order');
            $table->integer('status')->default(0); //show, hide
            $table->string('name');
            $table->integer('is_correct')->default(0); //true, false, null
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
        Schema::dropIfExists('question_items');
    }
};
