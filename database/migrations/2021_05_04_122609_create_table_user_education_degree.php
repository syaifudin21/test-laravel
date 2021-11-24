<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableUserEducationDegree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_user_education_degree', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string("translation", 255);
        });

        DB::table('table_user_education_degree')->insert([
            [
                "name"=>"Diploma 3",
                "translation"=>"Diploma 3"
            ],
            [
                "name"=>"Bachelor",
                "translation"=>"Sarjana"
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
        Schema::dropIfExists('table_user_education_degree');
    }
}
