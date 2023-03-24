<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('vendor_id')->unique();
            $table->string('password');

            $table->integer('pin');
            $table->string('mobile');

            $table->text('address');
            $table->string('city');
            $table->string('state');

            $table->text('shop');
            $table->string('landline')->nullable();
            $table->text('franchise');
            $table->text('business');

            $table->string('pan_number');
            $table->string('adhar_number');

            // uploads
            $table->text('adhar_card');
            $table->text('pan_card');
            $table->text('photograph');
            $table->text('signature');

            $table->decimal('balance')->default("0.00");
            $table->integer("status");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
