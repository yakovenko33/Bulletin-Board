<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAdverts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable("adverts")) {
            Schema::create('adverts', function (Blueprint $table) {
                $table->increments("id");
                $table->unsignedInteger("user_id");
                $table->string("headline", 50);
                $table->string("text", 255);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("adverts");
    }
}
