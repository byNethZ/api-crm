<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\ProspectInterest;
use App\Models\State;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CustomerController extends Controller
{
    public function show()
    {
        $userAuth = auth()->user();
        $user = User::find($userAuth->id);

        if ($user->role_id === 1) {

            $customers = Customer::all();
        } else {

            //real code
            $vendor_id = Vendor::where('user_id', $user->id)->first();

            //debug code
            $id = $vendor_id ? $vendor_id->id : 10;

            $customers = Customer::where('vendor_id', $id)->where('status', '=', 5)->get();
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
        $customerData = $request->customer;
        $customer = Customer::create([
            'name' => $customerData['name'],
            'phone' => $customerData['phone'],
            'email' => $customerData['email'],
            'type_id' => $customerData['type_id'],
            'field_1' => $customerData['field_1'],
            'field_2' => $customerData['field_2'] ? $customerData['field_2'] : null,
            'field_3' => $customerData['field_3'],
            'status' => $customerData['status'],
            'vendor_id' => $customerData['vendor_id'],
            'token' => $customerData['token']
        ]);

        $interestsJson = json_encode($request->interests);

        $interests = ProspectInterest::create([
            'customer_id' => $customer->id,
            'interests' => $interestsJson
        ]);

        $data = [
            'code' => 201,
            'customerCreated' => $customer,
            'interests' => $interests
        ];

        return response()->json($data, $data['code']);
    }

    public function index()
    {
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

    public function getDataByToken($token)
    {
        $customer = Customer::where('token', '=', $token)->first();
        $state = State::where('id', $customer->state_id)->first();
        $customer->bio = '';

        if ($customer) {
            $data = [
                'code' => 201,
                'customer' => $customer,
                'state' => $state ? $state->state_name : ''
            ];
        } else {
            $data = [
                'code' => 404,
                'message' => 'Customer not found'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function savePreferences(Request $request, $token)
    {
        $customer = Customer::where('token', '=', $token)->first();

        $isUpdated = $customer->update(array(
            'color' => $request['color'],
            'place' => $request['place'],
            'hobby' => $request['hobby'],
            'movie' => $request['movie'],
            'music' => $request['music'],
            'birthplace' => $request['birthplace'],
            'sport' => $request['sport'],
            'business_number' => $request['business_number'],
        ));

        if ($isUpdated) {
            $customerUpdated = $customer = Customer::where('token', '=', $token)->first();
            $data = [
                'code' => 201,
                'customerUpdated' => $customerUpdated
            ];
        } else {
            $data = [
                'code' => 400,
                'message' => 'Customer no updated'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function updateInterests(Request $request, $id)
    {

        $interests = ProspectInterest::where('customer_id', '=', $id)->first();

        $interestsJSON = json_encode($request->all());


        if ($interests) {
            //update interests
            $interests->update([
                'interests' => $interestsJSON
            ]);
        } else {
            //create interests
            $interests = ProspectInterest::create([
                'customer_id' => $id,
                'interests' => $interestsJSON
            ]);
        }

        $data = [
            'code' => 201,
            'message' => 'update interests',
            'interestsData' => $interests
        ];
        return response()->json($data, $data['code']);
    }

    public function getCustomerByStatus($status)
    {
        $userAuth = auth()->user();
        $user = User::find($userAuth->id);

        if ($user->role_id === 1) {

            $customers = Customer::all();
        } else {

            //real code
            $vendor_id = Vendor::where('user_id', $user->id)->first();

            //debug code
            $id = $vendor_id ? $vendor_id->id : 10;

            $customers = Customer::where('vendor_id', $id)->where('status', '=', $status)->with('interests')->with('industry')->get();
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'customers' => $customers
        ];

        return response()->json($data, $data['code']);
    }

    public function updateStatus($id, $status){
        $customer = Customer::find($id);
        $customer->update([
            'status' => $status
        ]);

        return $customer;
    }
}
