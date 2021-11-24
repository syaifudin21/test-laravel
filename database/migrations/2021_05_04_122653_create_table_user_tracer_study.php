<?php

use Faker\Factory as Faker;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableUserTracerStudy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_user_tracer_study', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("school_id")->unsigned()->nullable();
            $table->foreign('school_id')->references('id')->on('table_school');
            $table->string("name", 255);
            $table->string("description", 255);
            $table->date("target_start");
            $table->date("target_end");
            $table->date("publication_start");
            $table->date("publication_end");
        });

        $factory = Faker::create('id_ID');
        for($i=1; $i<=2; $i++){
            DB::table('table_user_tracer_study')->insert([
                "school_id"=>$i,
                "name"=>$factory->name,
                "description"=>$factory->text(255),
                "target_start"=>$factory->dateTimeBetween('-'.random_int(0,3).' years'),
                "target_end"=>$factory->dateTimeBetween('now','+'.random_int(0,5).' years'),
                "publication_start"=>$factory->dateTimeBetween('now', 'now'),
                "publication_end"=>$factory->dateTimeBetween('now', '+'.random_int(0,3).' months')
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
        Schema::dropIfExists('table_user_tracer_study');
    }
}
