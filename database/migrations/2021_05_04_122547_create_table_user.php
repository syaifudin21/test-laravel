<?php

use Faker\Factory as Faker;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_user', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string("phone", 255);
            $table->string("email", 255);
            $table->string("nim", 255);
        });

        $factory = Faker::create('id_ID');
        for($i=1; $i<=5; $i++){
            DB::table('table_user')->insert([
                "name"=>$factory->name(),
                "phone"=>$factory->phoneNumber,
                "email"=>$factory->email,
                "nim"=>$factory->randomNumber(9)
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_user');
    }
}
