<?php

use Faker\Factory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableUserEducationMajor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_user_education_major', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string("translation", 255);
        });
       
        DB::table('table_user_education_major')->insert([
            [
                "name"=>"accountant",
                "translation"=>"akutansi"
            ],
            [
                "name"=>"computer technic",
                "translation"=>"teknik komputer "
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_user_education_major');
    }
}
