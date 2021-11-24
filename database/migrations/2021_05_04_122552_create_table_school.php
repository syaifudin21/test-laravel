<?php

use Faker\Factory as Faker;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class CreateTableSchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_school', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string("phone", 255);
            $table->string("email", 255);
            $table->string("fax", 255);
            $table->string("address", 255);
            $table->string("website", 255);
            $table->string("logo", 255);
            $table->string("postal_code", 255);
            $table->string("about", 255);
            $table->string("mission", 255);
            $table->string("vision", 255);
        });

        $factory = Faker::create('id_ID');
        for($i=1; $i<=2; $i++){
            DB::table('table_school')->insert([
                "name"=>$factory->name(),
                "phone"=>$factory->phoneNumber,
                "email"=>$factory->email,
                "fax"=>$factory->phoneNumber,
                "address"=>$factory->address,
                "website"=>$factory->url,
                "logo"=>"media/x.jpg",
                "postal_code"=>$factory->postcode,
                "about"=>$factory->words(7, true),
                "mission"=>$factory->words(20, true),
                "vision"=>$factory->words(20, true),
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
        Schema::dropIfExists('table_school');
    }
}
