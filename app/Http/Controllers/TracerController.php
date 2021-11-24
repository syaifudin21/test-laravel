<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;


class TracerController extends Controller
{
    //menampilkan perulangan yang ada di table 
    public function index(Request $request)
    {
        $tracerStudys = DB::table('table_user_tracer_study')->simplePaginate();
        return response()->json($tracerStudys, 200);
    }
    //menyimpan data tracer study
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //validasi jika tidak ada di table_school
            'school_id' => 'required|exists:table_school,id',

            'name'=> 'required', 
            'description'=> 'required',
            'target_start'=> 'required|date',
            'target_end'=> 'required|date',
            'publication_start'=> 'required|date',
            'publication_end'=> 'required|date',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        // query builder menyimpan data tracer
        $tracerStudy = DB::table('table_user_tracer_study')->insert([
            'school_id' => $request->school_id, 
            'name'=> $request->name, 
            'description'=> $request->description,
            'target_start'=> $request->target_start,
            'target_end'=> $request->target_end,
            'publication_start'=> $request->publication_start,
            'publication_end' => $request->publication_end
        ]);

        if($tracerStudy){
            return response()->json([
                'message' => 'Berhasil menyimpan tracer study'
            ], 201);
        }else{
            return response()->json([
                'message' => 'Terjadi kesalahan penulisan pada database'
            ], 400);
        }

    }

    //menampilkan study tracer ada di table 
    public function show($id)
    {
        $tracerStudys = DB::table('table_user_tracer_study')->where('id',$id)->first();
        return response()->json($tracerStudys, 200);
    }

    // mengupdate traccer study
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            //validasi jika tidak ada di table_school
            'school_id' => 'required|exists:table_school,id',

            'name'=> 'required', 
            'description'=> 'required',
            'target_start'=> 'required|date',
            'target_end'=> 'required|date',
            'publication_start'=> 'required|date',
            'publication_end'=> 'required|date',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        // query builder menyimpan data tracer
        $tracerStudy = DB::table('table_user_tracer_study')->where('id',$id)->update([
            'school_id' => $request->school_id, 
            'name'=> $request->name, 
            'description'=> $request->description,
            'target_start'=> $request->target_start,
            'target_end'=> $request->target_end,
            'publication_start'=> $request->publication_start,
            'publication_end' => $request->publication_end
        ]);

        if($tracerStudy){
            return response()->json([
                'message' => 'Berhasil mengupdate tracer study'
            ], 201);
        }else{
            return response()->json([
                'message' => 'Tidak ada perubahan dalam database, dikarenakan data yang dimasukkan sama persis'
            ], 400);
        }
    }


    // mengupdate traccer study
    public function delete(Request $request, $id)
    {
        // query builder menyimpan data tracer
        $tracerStudy = DB::table('table_user_tracer_study')->where('id',$id)->delete();

        if($tracerStudy){
            return response()->json([
                'message' => 'Berhasil menghapus tracer study'
            ], 201);
        }else{
            return response()->json([
                'message' => 'Data yang mau dihapus tidak diketemukan'
            ], 400);
        }
    }
}
