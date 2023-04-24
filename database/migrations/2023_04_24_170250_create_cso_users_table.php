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
        Schema::create('cso_users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('division')->nullable();
            $table->string('occupication')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('ethnicity')->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cso_users');
    }
};
