<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();

            $table->string('fav_icon')->nullable();

            $table->string('number1')->nullable();

            $table->string('number2')->nullable();

            $table->string('email1')->nullable();

            $table->string('email2')->nullable();

            $table->string('address')->nullable();

            $table->string('facebook')->nullable();

            $table->string('youtube')->nullable();

            $table->string('instagram')->nullable();

            $table->string('twitter')->nullable();


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
        Schema::dropIfExists('settings');
    }
}
