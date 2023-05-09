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
    public function indexByVendor($customerID)
    {

        if ($customerID === '99') {

            $customers = Customer::where('status', '=', 5)->orderBy('id', 'DESC')->paginate(40);
        } else {

            $customers = Customer::where('vendor_id', $customerID)->where('status', '=', 5)->orderBy('id', 'DESC')->paginate(40);
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

        if ($request->customer) {
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

        if ($request->interests) {
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
        if (isset($request->customer)) {
            $message->notifySaveCustomer($userAuth, $customer, $industry, $request->interests, true);
        } else {
            $message->notifySaveCustomer($userAuth, $customer, $industry, null, false);
        }

        if ($customerData['field_2']) {
            $userAssigned = User::find($customerData['vendor_id']);
            $nameAssigner = auth()->user()->name;
            $message->notifyAssignedCustomer($customer, $userAssigned, $industry, $request->interests, $nameAssigner);
        }

        return response()->json($data, $data['code']);
    }

    public function index()
    {
        $customers = Customer::orderBy('id', 'DESC')
            ->select('vendor_id', 'status', 'phone', 'business', 'name', 'surname', 'address', 'email')
            ->get();

        $data = [
            'code' => 200,
            'status' => 'success',
            'customers' => $customers
        ];

        return response()->json($data, $data['code']);
    }

    public function indexJustCustomers()
    {
        if ((auth()->user()->departament_id === 4 ||
            auth()->user()->departament_alt_id === 4
        ) && auth()->user()->role_id !== 1) {
            $customers = Customer::where('status', 5)
                ->where('vendor_id', auth()->user()->id)
                ->orderBy('id', 'DESC')
                ->select('id', 'vendor_id', 'status', 'phone', 'business', 'name', 'surname', 'address', 'state_id', 'zipcode', 'email')
                ->get();
        } else {
            $customers = Customer::where('status', 5)
                ->orderBy('id', 'DESC')
                ->select('id', 'vendor_id', 'status', 'phone', 'business', 'name', 'surname', 'address', 'state_id', 'zipcode', 'email')
                ->get();
        }

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
        $customer->update($dataChanged->except('image'));

        return $dataChanged;
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
    public function getCustomersByProperty($property, $idProperty, $vendorID)
    {

        if ($vendorID === '99') {

            $customers = Customer::where($property, '=', $idProperty)->with('interests')->with('industry')->with('vendor')->orderBy('id', 'DESC')->paginate(40);
        } else {
            $customers = Customer::where('vendor_id', $vendorID)->where($property, '=', $idProperty)->with('interests')->with('industry')->with('vendor')->orderBy('id', 'DESC')->paginate(40);
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'property' => $property,
            'customers' => $customers
        ];

        return response()->json($data, $data['code']);
    }

    public function getAllProspects()
    {
        $userAuth = auth()->user();

        if ($userAuth->role_id === 1 || $userAuth->id === 3) {

            $customers = Customer::where('status', '!=', 4)
                ->where('status', '!=', 5)
                ->where('status', '!=', 6)
                ->with('interests')->with('industry')->with('vendor')
                ->orderBy('id', 'DESC')
                ->paginate(40);
        } else {
            $id = 2;

            if ($userAuth->departament_id === 4 || $userAuth->departament_alt_id === 4) {
                $id = $userAuth->id;
            }

            $customers = Customer::where('vendor_id', $id)
                ->where('status', '!=', 4)
                ->where('status', '!=', 5)
                ->where('status', '!=', 6)
                ->with('interests')->with('industry')->with('vendor')
                ->orderBy('id', 'DESC')
                ->paginate(40);
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'prospects' => $customers,
        ];

        return response()->json($data, $data['code']);
    }

    public function updateStatus($id, $status)
    {
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

    public function changeVendor($id, $status, Request $request)
    {

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

        if ($interests) {
            $interestsJSON = json_decode($interests->interests);
        }

        $message = new WhatsAppChannel;
        $userAssigned = User::find($request->vendor_id);
        $nameAssigner = auth()->user()->name;

        $message->notifyAssignedCustomer($customerUpdated, $userAssigned, $industry, $interestsJSON, $nameAssigner);

        return $customerUpdated;
    }

    public function uploadImage(Request $request, $id)
    {
        $customer = Customer::find($id);
        $image_name = 'default.jpg';

        $prevImage = $customer->image;
        $exists = false;

        if ($request->hasFile('image')) {
            $image_name = time() . $request->file('image')->getClientOriginalName();
            $fileName = $request->file('image')->storeAs('public/customers', $image_name);

            if (File::exists('storage/customers/' . $customer->image)) {
                File::delete('storage/customers/' . $customer->image);
                $exists = true;
            }

            $customer->update([
                'image' => $image_name
            ]);
        }

        $data = [
            'prevImage' => $prevImage,
            'newImage' => $customer->image,
            'customer' => $customer,
            'exists' => $exists
        ];

        return response()->json($data, 200);
    }
}
