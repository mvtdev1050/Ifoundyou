<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privacies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->enum('email_privacy', array('Friends', 'Public', 'Only Me'))->default('Public')->nullable();
            $table->enum('phone_privacy', array('Friends', 'Public', 'Only Me'))->default('Public')->nullable();
            $table->enum('friends_privacy', array('Friends', 'Public', 'Only Me'))->default('Public')->nullable();
            $table->enum('photos_privacy', array('Friends', 'Public', 'Only Me'))->default('Public')->nullable();
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
        Schema::dropIfExists('privacies');
    }
}
