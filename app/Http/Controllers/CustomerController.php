<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function show(){
        $userAuth = auth()->user();
        $user = User::find($userAuth->id);

        if($user->role_id === 1){

            $customers = Customer::all();

        }else{

            //real code
            //$vendor_id = Vendor::where('user_id', $user->id)->first();

            //debug code
            $vendor_id = 2;

            $customers = Customer::where('vendor_id', $vendor_id)->get();

        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'customers' => $customers
        ];

        return response()->json($data, $data['code']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
        ]);

        return Customer::create($request->all());
    }

    public function index(){
        $customers = Customer::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'customers' => $customers
        ];

        return response()->json($data, $data['code']);

    }

    public function destroy($id)
    {
        return Customer::destroy($id);
    }

    public function showCustomer($id)
    {
        $customer = Customer::find($id);

        $data = [
            'code' => 200,
            'status' => 'success',
            'customer' => $customer
        ];

        return response()->json($data, $data['code']);
    }
}
