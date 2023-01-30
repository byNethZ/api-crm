<?php

namespace App\Http\Controllers;

use App\WhatsAppChannel\WhatsAppChannel;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\ProspectInterest;
use App\Models\State;
use App\Models\User;
use App\Models\Vendor;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client;

class CustomerController extends Controller
{
    public function indexByVendor()
    {
        $userAuth = auth()->user();

        if ($userAuth->role_id === 1 || $userAuth->id === 3) {

            $customers = Customer::where('status', '=', 5)->orderBy('id', 'DESC')->get();
        } else {
            $id = 10;

            if($userAuth->departament_id == 4 || $userAuth->departament_alt_id == 4){
                $id = $userAuth->id;
            }

            $customers = Customer::where('vendor_id', $id)->where('status', '=', 5)->orderBy('id', 'DESC')->get();
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

        $userAuth = auth()->user();

        if($request->customer){
            $customerData = $request->customer;
            $isProspect = true;
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
        } else {
            $customerData = $request;
            $isProspect = false;

            $dateFormatted = date('Y-m-d', strtotime($request->birthday));
            $dataChanged = $request->merge(['birthday' => $dateFormatted]);

            $customer = Customer::create($dataChanged->all());
        }

        if($request->interests){
            $interestsJson = json_encode($request->interests);

            $interests = ProspectInterest::create([
                'customer_id' => $customer->id,
                'interests' => $interestsJson
            ]);
        }

        $data = [
            'code' => 201,
            'customerCreated' => $customer,
            'interests' => isset($interests) ? $interests : null,
            'isProspect' => $isProspect
        ];

        $industry = CustomerType::where('id', $customer->type_id)->first();

        $message = new WhatsAppChannel;
        if(isset($request->customer)){
            $message->notifySaveCustomer($userAuth, $customer, $industry, $request->interests, true);
        } else {
            $message->notifySaveCustomer($userAuth, $customer, $industry, null, false);
        }

        if($customerData['field_2']){
            $userAssigned = User::find($customerData['vendor_id']);
            $message->notifyAssignedCustomer($customer, $userAssigned, $industry, $request->interests);
        }

        return response()->json($data, $data['code']);
    }

    public function index()
    {
        $customers = Customer::orderBy('id', 'DESC')->get();

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

    public function show($id)
    {
        $customer = Customer::find($id);
        $category = CustomerType::where('id', $customer->type_id)->first();
        $categoryName = $category ? $category->type : '';

        $user = User::where('id', $customer->vendor_id)->first();

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
        $dateFormatted = date('Y-m-d', strtotime($request->birthday));
        $dataChanged = $request->merge(['birthday' => $dateFormatted]);
        $customer->update($dataChanged->all());

        return $request;
    }

    public function prospectRejected(Request $request, $id)
    {
        $customer = Customer::find($id);

        $customer->update([
            'notes' => $request->notes,
            'status' => 4
        ]);

        return $request;
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

    //This function will replace functions "getCustomerByStatus" and "getCustomersByIndustry" after modifying services in client
    public function getCustomersByProperty($property, $idProperty){
        $userAuth = auth()->user();

        if ($userAuth->role_id === 1 || $userAuth->id === 3) {

            $customers = Customer::where($property, '=', $idProperty)->with('interests')->with('industry')->with('vendor')->orderBy('id', 'DESC')->get();
        } else {
            $id = 10;

            if($userAuth->departament_id == 4 || $userAuth->departament_alt_id == 4){

                $id = $userAuth->id;

            }

            $customers = Customer::where('vendor_id', $id)->where($property, '=', $idProperty)->with('interests')->with('industry')->with('vendor')->orderBy('id', 'DESC')->get();
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'property' => $property,
            'customers' => $customers
        ];

        return response()->json($data, $data['code']);
    }

    public function getAllProspects(){
        $userAuth = auth()->user();

        if ($userAuth->role_id === 1 || $userAuth->id === 3) {

            $customers = Customer::where('status', '!=', 4)
                ->where('status', '!=', 5)
                ->where('status', '!=', 6)
                ->with('interests')->with('industry')->with('vendor')
                ->orderBy('id', 'DESC')
                ->paginate(50);
                //->paginate(2);
        } else {
            $id = 10;

            if($userAuth->departament_id == 4 || $userAuth->departament_alt_id == 4){
                $id = $userAuth->id;
            }

            $customers = Customer::where('vendor_id', $id)
                ->where('status', '=', 4)
                ->where('status', '=', 5)
                ->where('status', '=', 6)
                ->with('interests')->with('industry')->with('vendor')
                ->orderBy('id', 'DESC')
                ->paginate(50);
                //->paginate(2);
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'prospects' => $customers
        ];

        return response()->json($data, $data['code']);
    }

    //Clear this function when the corresponding services in client have been updated
/*     public function getCustomerByStatus($status)
    {
        $userAuth = auth()->user();

        if ($userAuth->role_id === 1 || $userAuth->id === 3) {

            $customers = Customer::where('status', '=', $status)->with('interests')->with('industry')->with('vendor')->orderBy('id', 'DESC')->get();
        } else {
            $id = 10;

            if($userAuth->departament_id == 4 || $userAuth->departament_alt_id == 4){

                $id = $userAuth->id;
                $customers = Customer::where('vendor_id', $id)->where('status', '=', $status)->with('interests')->with('industry')->orderBy('id', 'DESC')->get();

            } else {

                $customers = Customer::where('status', '=', $status)->with('interests')->with('industry')->with('vendor')->orderBy('id', 'DESC')->get();
            }

        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'customers' => $customers
        ];

        return response()->json($data, $data['code']);
    } */

    //Clear this function when the corresponding services in client have been updated
/*     public function getCustomersByIndustry($industry){
        $userAuth = auth()->user();

        if ($userAuth->role_id === 1 || $userAuth->id === 3) {

            $customers = Customer::where('type_id', '=', $industry)->with('interests')->with('vendor')->orderBy('id', 'DESC')->get();
        } else {
            $id = 10;

            if($userAuth->departament_id == 4 || $userAuth->departament_alt_id == 4){
                $id = $userAuth->id;
            }

            $customers = Customer::where('vendor_id', $id)->where('type_id', '=', $industry)->with('interests')->orderBy('id', 'DESC')->get();
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'customers' => $customers
        ];

        return response()->json($data, $data['code']);
    } */

    public function updateStatus($id, $status){
        $userAuth = auth()->user();

        $customer = Customer::find($id);
        $customer->update([
            'status' => $status
        ]);
        $customerUpdated = Customer::find($id);

        $status = Utils::formatStatus($customerUpdated->status);

        $industry = CustomerType::where('id', $customer->type_id)->first();

        $message = new WhatsAppChannel;
        $message->notifyChangeStatus($userAuth, $customer, $status, $industry);

        return $customerUpdated;
    }

    public function changeVendor($id, $status, Request $request){

        $customer = Customer::find($id);
        $customer->update([
            'status' => $status,
            'vendor_id' => $request->vendor_id
        ]);
        $customerUpdated = Customer::find($id);

        $status = Utils::formatStatus($customerUpdated->status);

        $industry = CustomerType::where('id', $customer->type_id)->first();

        $interests = ProspectInterest::where('customer_id', '=', $customerUpdated->id)->first();
        $interestsJSON = null;

        if($interests){
            $interestsJSON = json_decode($interests->interests);
        }

        $message = new WhatsAppChannel;
        $userAssigned = User::find($request->vendor_id);

        $message->notifyAssignedCustomer($customerUpdated, $userAssigned, $industry, $interestsJSON);

        return $customerUpdated;
    }

    public function uploadImage(Request $request, $id){
        $customer = Customer::find($id);
        $image_name = 'default.jpg';

        $prevImage = isset($customer->image) ? $customer->image : 'default.jpg';
        $exists = false;

        if($request->hasFile('image')){
            $image_name = time().$request->file('image')->getClientOriginalName();
            $fileName = $request->file('image')->storeAs('public/customers', $image_name);

            if(isset($customer->image) && File::exists('storage/customers/'.$customer->image)){
                File::delete('storage/customers/'.$customer->image);
                $exists = true;
            }

            $customer->image = $image_name;
            $customer->save();
        }
        $data = [
            'prevImage' => $prevImage,
            'newImage' => $customer->image,
            'exists' => $exists
        ];

        return response()->json($data, 200);
    }
}
