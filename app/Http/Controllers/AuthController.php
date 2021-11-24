<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\TableUser;
use Illuminate\Http\Request;
use DB;
use JWTAuth;

use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.jwt', ['except' => ['login']]);
    }
    

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email|max:255',
    //         'nim' => 'required|integer',
    //     ]);
        
    //     if($validator->fails()){
    //         return response()->json($validator->errors(), 400);
    //     }
    //     $email = $request->email;
        

    //     $user = TableUser::where('email', $email)->first();
    //     try { 
    //         // verify the credentials and create a token for the user
    //         if (! $token = JWTAuth::fromUser($user)) { 
    //             return response()->json(['error' => 'invalid_credentials'], 401);
    //         } 
    //     } catch (JWTException $e) { 
    //         // something went wrong 
    //         return response()->json(['error' => 'could_not_create_token'], 500); 
    //     } 
    //     // if no errors are encountered we can return a JWT 
    //     return response()->json(compact('token')); 
    // }

    public function login(Request $request)
    {
        //validasi jika email atau nim tidak diikut sertakan
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'nim' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        //karena tidak ada password dalam table, untuk login dengan kombinasi email dan nim
        $user = TableUser::where(['email' => $request->email , 'nim'=> $request->nim])->first();

        // validasi awal jika tidak ditemukan di database
        if($user){
            try {
                //pembuatan token sekaligus validasi
                if (!$token = JWTAuth::fromUser($user)) {
                    return response()->json([
                        'error' => 'Kombinasi Email dan Password yang anda masukkan tidak sesuai'
                    ], 401);
                }
            } catch (JWTException $e) {
                // response error jika system packege jwt bermasalah
                return response()->json([
                    'error' => 'Sistem token sedang bermasalah ["Gagal Create token"]'
                ], 500);
            }
        }else{
            // respon jika data tidak ditemukan di database
            return response()->json([
                'error' => 'Kombinasi Email dan Password yang anda masukkan tidak sesuai'
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    public function getUser(){
        $user = auth('api')->user();
        return response()->json(['user'=>$user], 201);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // fungsi sederhanda logout 
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}