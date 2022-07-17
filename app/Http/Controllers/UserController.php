<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Departament;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return User::with('departament')->get();
    }

    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();


        if (! $user || ! Hash::check($request->password, $user->password)) {
            $data = [
                'code' => 401,
                'status' => 'error',
                'message' => 'Login incorrecto'
            ];
        } else{
            $vendor_id = $user->departament_id == 4 ? Vendor::where('user_id', $user->id)->first() : null;
            $token = $user->createToken('auth_token')->plainTextToken;

            $data = [
                'code' => 200,
                'status' => 'success',
                'token' => $token,
                'token_type' => 'Bearer',
                'name' => $user->name,
                'id' => $user->id,
                'vendor_id' => $vendor_id ? $vendor_id->id : null,
                'role_id' => $user->role_id,
                'departament_id' => $user->departament_id,
                'departament_alt_id' => $user->departament_alt_id,
            ];
        }

        return response()->json($data, $data['code']);

    }

    public function update (Request $request, $id){
        $user = User::find($id);
        $user->update($request->all());
        return $user;
    }

    public function resetPass($id, Request $request){
        $password = Hash::make($request['password']);

        $user = User::find($id)->update(array('password' => $password));
        $data = [
            'code' => 201,
            'user' => $user
        ];

        return response()->json($data, $data['code']);

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
    }

    public function info(){
        //$user = User::find($id);
        $user = auth()->user();

        //return auth()->user();
        return response()->json($user, 200);
    }

    public function validateToken(Request $request){
        $user = auth()->user();
        if($user){
            return response()->json($user, 200);
        }
        else{
            return response()->json(['message' => 'Invalid token'], 200);
        }
    }

    public function show($id)
    {
        $user = User::find($id);
        $departament = $user->departament()->get();
        //$category = userCategory::where('id', $product->category_id)->first();

        $data = [
            'code' => 201,
            'user' => $user,
            'departament' => $departament ? $departament[0]->name : null
        ];

        return response()->json($data, $data['code']);
    }

    public function delete($id){

        $user = User::where('id', $id)->first();

        if($user->departament_id == 4 || $user->departament_alt_id == 4 ){
            $vendor = Vendor::where('user_id', $id)->first();
            $customers = Customer::where('vendor_id', $vendor->id)->get();
             if(count($customers) !== 0){

                DB::table('customers')->where('vendor_id', $vendor->id)->update(array('vendor_id' => 10));
             }
            $user->delete();
            $vendor->delete();
            $data = [
                'code' => 201,
                'user' => $user,
                'vendor' => $vendor ? $vendor : null,
            ];

            return response()->json($data, $data['code']);
        }

        $user->delete();

        $data = [
            'code' => 201,
            'user' => $user,
        ];
        return response()->json($data, $data['code']);
    }

    public function indexDepartament(){
        return Departament::all();
    }

    public function store(Request $request){

        $request->except(['id']);
        $request['password'] = Hash::make($request['password']);

        return User::create($request->all());
    }

    public function publicDepartament(){
        return Departament::where('public', '=', 1)->get();
    }

}
