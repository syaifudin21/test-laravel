<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class UserEducationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $school = DB::select("select * from table_school where id = $this->school_id")[0];
        if($school){
            $school = [
                'name'         => $school->name,
                'phone'        => $school->phone,
                'email'        => $school->email,
                'fax'          => $school->fax,
                'address'      => $school->address,
                'website'      => $school->website,
                'logo'         => $school->logo,
                'postal_code'  => $school->postal_code,
                'about'        => $school->about,
                'mission'      => $school->mission,
                'vision'       => $school->vision,
            ];
        }else{
            $school = null;
        }

        $major = DB::select("select * from table_user_education_major where id = $this->major_id")[0];
        if($major){
            $major = [
                'name'        => $major->name,
                'translation' => $major->translation,
            ];
        }else{
            $major = null;
        }

        $degree = DB::select("select * from table_user_education_degree where id = $this->degree_id")[0];
        if($degree){
            $degree = [
                'name'        => $degree->name,
                'translation' => $degree->translation,
            ];
        }else{
            $degree = null;
        }

        $traceStudy = DB::select("select * from table_user_tracer_study where school_id = $this->school_id")[0];
        if($traceStudy){
            $traceStudy = [
                'school_id'            => $traceStudy->school_id,
                'name'                 => $traceStudy->name,
                'description'          => $traceStudy->description,
                'target_start'         => $traceStudy->target_start,
                'target_end'           => $traceStudy->target_end,
                'publication_start'    => $traceStudy->publication_start,
                'publication_end'      => $traceStudy->publication_end,
            ];
        }else{
            $traceStudy = null;
        }

        return [
            'gpa'          => $this->gpa,
            'nim'          => $this->nim,
            'date_start'   => $this->date_start,
            'date_end'     => $this->date_end,
            'degree_id'    => $this->degree_id,
            'school_id'    => $this->school_id,
            'user_id'      => $this->user_id,
            'major_id'     => $this->major_id,
            'school'       => $school,
            'major'        => $major,
            'degree'       => $degree,
            'this_study' => $traceStudy
        ];
    }
}
