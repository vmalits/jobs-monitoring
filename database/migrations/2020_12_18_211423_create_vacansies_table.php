<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacansiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacansies', function (Blueprint $table) {
            $table->id();
            $table->string('position')->nullable(false);
            $table->string('organization')->nullable(false);
            $table->string('requirements')->nullable(true);
            $table->string('salary')->default(0);
            $table->string('salary_from')->default(0);
            $table->string('salary_to')->default(0);
            $table->string('vacancy_link')->nullable(false);
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
        Schema::dropIfExists('vacansies');
    }
}
