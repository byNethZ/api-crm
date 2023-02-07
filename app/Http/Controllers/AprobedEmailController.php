<?php

namespace App\Http\Controllers;

use App\Models\AprobedEmail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\AprobedEmailMailable;
use App\WhatsAppChannel\WhatsAppChannel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AprobedEmailController extends Controller
{
    // From old system
    public function generate(Request $request)
    {
        $request->validate([
            'urlDropbox' => 'required',
            'restaurant' => 'required'
        ]);

        $aprobedEmail = new AprobedEmail();

        $aprobedEmail->customer = $request->input('restaurant');
        $aprobedEmail->customer_id = 0;
        $aprobedEmail->user_id = $request->input('user_id');
        $aprobedEmail->type = 'menu';
        $aprobedEmail->urldropbox = $request->input('urlDropbox');
        $aprobedEmail->aprobed = 0;
        $aprobedEmail->approver = '';
        $aprobedEmail->message = '';

        $aprobedEmail->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'checklist' => $aprobedEmail
        ];

        return response()->json($data, $data['code']);
    }

    // From CRM
    public function create(Request $request)
    {
        $request->validate([
            'urldropbox' => 'required',
            'customer' => 'required',
            'type' =>  'required'
        ]);

        $aprobedEmail = new AprobedEmail();

        $aprobedEmail->customer = $request->input('customer');
        $aprobedEmail->customer_id = $request->input('customer_id');
        $aprobedEmail->user_id = $request->input('user_id');
        $aprobedEmail->type = $request->input('type');
        $aprobedEmail->urldropbox = $request->input('urldropbox');
        $aprobedEmail->aprobed = 0;
        $aprobedEmail->approver = '';
        $aprobedEmail->message = '';
        $aprobedEmail->notes = $request->input('notes');

        $aprobedEmail->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'checklist' => $aprobedEmail
        ];

        return response()->json($data, $data['code']);
    }

    //For client checklist form
    public function show($id)
    {
        $aprobedemail = AprobedEmail::find($id);
        $aprobedemail->makeHidden('notes');

        if (is_object($aprobedemail)) {
            $data = array(
                'code' => 200,
                'status' => 'success',
                'user' => $aprobedemail
            );
        } else {
            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => 'El checklist no existe'
            );
        }

        return response()->json($data, $data['code']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'urldropbox' => 'required|string',
            'customer' => 'required|string',
            'type' =>  'required|string',
            'notes' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $checklist = AprobedEmail::find($id);

        $updated = $checklist->update([
            'urldropbox' => $validated['urldropbox'],
            'customer' => $validated('customer'),
            'type' => $validated('type'),
            'aprobed' => 0,
            'approver' => '',
            'message' => '',
            'notes' => $request->input('notes')
        ]);

        $data = [
            'code' => 200,
            'updated' => $checklist
        ];

        return response()->json($data, $data['code']);
    }

    //From clients checklists form
    public function approve($id, Request $request)
    {

        $approver = $request['approver'];
        $aprobed = $request['aprobed'] ? $request['aprobed'] : 1;
        $message = $request['message'] ? $request['message'] : '';

        $aprobedEmailUpdate = AprobedEmail::find($id);

        $aprobedEmailUpdate->update(array('aprobed' => $aprobed, 'approver' => $approver, 'message' => $message));

        $user_id = $aprobedEmailUpdate->user_id;
        $user = User::find($user_id);

        //Sending WhatsAppChannel
        $message = new WhatsAppChannel();
        $message->notifyStatusChecklist($user, $aprobedEmailUpdate);

        //Sending email process

        $email = $user->email;

        if ($user->role_id == 1 && $user->departament_id == 6) {
            //sending email
            $correo = new AprobedEmailMailable($aprobedEmailUpdate);
            Mail::to($email)->send($correo);
            return;
        }

        //sending email
        $correo = new AprobedEmailMailable($aprobedEmailUpdate);
        Mail::to($email)
            ->cc(['design@bliones.com'])
            ->send($correo);


        //Answer
        $data = [
            'code' => 200,
            'status' => 'success',
            'approver' => $approver,
            'aprobedemailsUpadte' => $aprobedEmailUpdate
        ];

        return response()->json($data, $data['code']);
    }

    public function index($status)
    {
        //$user = User::find($id);
        $user = auth()->user();

        if ($user->role_id === 1) {
            if ($status === '99') {
                $emails = AprobedEmail::latest()->with(['user' => function ($query) {
                    $query->select('id', 'name');
                }])->paginate(20);
            } else {
                $emails = AprobedEmail::latest()->where('aprobed', $status)->with(['user' => function ($query) {
                    $query->select('id', 'name');
                }])->paginate(20);
            }
        } else {
            if ($status === '99') {
                $emails = AprobedEmail::latest()->where('user_id', $user->id)->paginate(20);
            } else {
                $emails = AprobedEmail::latest()->where('user_id', $user->id)->where('aprobed', $status)->paginate(20);
            }
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'links' => $emails,
        ];

        return response()->json($data, $data['code']);
    }

    public function delete($id)
    {
        return AprobedEmail::destroy($id);
    }

    public function changeStatus($id)
    {
        $link = AprobedEmail::find($id);
        $link->aprobed = 0;
        $link->approver = '';
        $link->message = '';
        $link->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'linkChanger' => $link
        ];

        return response()->json($data, $data['code']);
    }
}
