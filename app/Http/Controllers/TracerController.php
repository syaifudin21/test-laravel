<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserEducationResource;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;


class TracerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.jwt', ['except' => ['show']]);
    }

    //jawaban pertanyaan nomor 1
    public function number1(Request $request)
    {
        // fungsi jika api diakses tanpa parameter gpa_min;
        $gpa_min = $request->gpa_min ?? 0;
        $date_start = date('Y-m-d', $request->date_start) ?? date('Y-m-d');
        $end_date = date('Y-m-d');

        //penggunaan select tanpa join memberikan peforma yang lebih, 
        $tracers = DB::select("select * from table_user_education where gpa > '$gpa_min' AND date_start >= '$date_start' AND date_end <= '$end_date' ORDER BY gpa DESC");
        

        // struktur yang terlalu kompleks akan dibuatkan pada satu file untuk merapikan code
        return UserEducationResource::collection($tracers);
    }

    //menampilkan perulangan yang ada di table 
    public function index(Request $request)
    {
        //karena TIDAK ADA dipersoalan saya menggunakan query builder untuk mempermudah paginate, 
        $tracerStudys = DB::table('table_user_tracer_study')->simplePaginate();
        return response()->json($tracerStudys, 200);
    }

    //menyimpan data tracer study
    public function store(Request $request)
    {
        // validasi sederhana paramter yang wajib di includkan ketika api diakses
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

        // melakukan uji query apakah tidak ada kesalahan sql penulisan
        try {
            DB::select("INSERT INTO table_user_tracer_study  
            (school_id, name, description, target_start,target_end, publication_start, publication_end) values 
            ('$request->school_id', '$request->name', '$request->description', '$request->target_start', '$request->target_end', '$request->publication_start', '$request->publication_end')");

            return response()->json([
                'message' => 'Berhasil menambahkan data'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal melakukan panambahan data'
            ], 400);
        }

    }

    //menampilkan study tracer ada di table 
    public function show($id)
    {
        $tracerStudys = DB::select("select * from table_user_tracer_study where id = '$id'")[0];
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

        // melakukan uji query apakah tidak ada kesalahan sql penulisan
        try {
            DB::select("update table_user_tracer_study set
            school_id = '$request->school_id',
            name= '$request->name', 
            description= '$request->description',
            target_start= '$request->target_start',
            target_end= '$request->target_end',
            publication_start= '$request->publication_start',
            publication_end = '$request->publication_end'
            where id = '$id'");

            return response()->json([
                'message' => 'Berhasil mengupdate tracer study'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal melakukan update'
            ], 400);
        }
        

    }


    // mengupdate traccer study
    public function delete(Request $request, $id)
    {
        try {
            DB::select("delete table_user_tracer_study where id = '$id'");

            return response()->json([
                'message' => 'Berhasil menghapus tracer study'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Data yang mau dihapus tidak diketemukan'
            ], 400);
        }
    }
}
