<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");

            $table->string("category");
            $table->date("date");

            $table->string("pan_number")->nullable();

            $table->string("first_name");
            $table->string("middle_name")->nullable();
            $table->string("last_name");

            $table->string("father_first_name");
            $table->string("father_middle_name")->nullable();
            $table->string("father_last_name");

            $table->string("card_name")->nullable();

            $table->date("dob");
            $table->integer("gender");

            $table->string("mobile");
            $table->string("email");

            //Address
            $table->text("c_o")->nullable();
            $table->text("flat")->nullable();
            $table->text("premises")->nullable();
            $table->text("road")->nullable();
            $table->text("area");
            $table->string("city");
            $table->string("state");
            $table->string("area_pin");

            $table->string("adhar_number");
            $table->text("adhar_proof");

            $table->text("identity_proof");
            $table->text("address_proof");
            $table->text("dob_proof");

            $table->string("pin");
            $table->decimal("fee");

            $table->text("documents")->nullable();
            $table->text("receipt")->nullable();
            $table->text("photo")->nullable();
            $table->text("signature")->nullable();

            $table->text("reject_reason")->nullable();

            $table->integer("status");

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
        Schema::dropIfExists('pans');
    }
}
