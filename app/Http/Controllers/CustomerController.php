<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\State;
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
            $vendor_id = Vendor::where('user_id', $user->id)->first();

            //debug code
            $id = $vendor_id ? $vendor_id : 10;

            $customers = Customer::where('vendor_id', $id)->get();

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
        $request->except(['id']);

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
        $category = CustomerType::where('id', $customer->type_id)->first();
        $categoryName = $category ? $category->type : '';

        $vendor = Vendor::where('id', $customer->vendor_id)->first();
        $user = $vendor->user()->first();

        $state = State::where('id', $customer->state_id)->first();

        $data = [
            'code' => 200,
            'status' => 'success',
            'customer' => $customer,
            'category' => $categoryName,
            'asesor' => $user,
            'state' => $state ? $state->state_name : ''
        ];

        return response()->json($data, $data['code']);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->update($request->all());

        return $customer;
    }
}
