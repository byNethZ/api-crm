<?php

namespace App\Http\Controllers;

use App\Models\AprobedEmail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\AprobedEmailMailable;
use Illuminate\Support\Facades\Mail;

class AprobedEmailController extends Controller
{
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

    public function create(Request $request)
    {
        $request->validate([
            'urldropbox' => 'required',
            'customer' => 'required'
        ]);

        $aprobedEmail = new AprobedEmail();

        $aprobedEmail->customer = $request->input('customer');
        $aprobedEmail->user_id = $request->input('user_id');
        $aprobedEmail->urldropbox = $request->input('urldropbox');
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

    public function store($id)
    {
        $aprobedemail = AprobedEmail::find($id);

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
                'message' => 'El usuario no existe'
            );
        }

        return response()->json($data, $data['code']);
    }

    public function update($id, Request $request)
    {

        //Saving data in db
        /*         $request->validate([
            'approver' => 'required'
        ]); */

        $approver = $request['approver'];
        $aprobed = 1;

        $aprobedEmailUpdate = AprobedEmail::find($id);

        $aprobedEmailUpdate->update(array('aprobed' => $aprobed, 'approver' => $approver));

        //Sending email process

        $user_id = $aprobedEmailUpdate->user_id;
        $user = User::find($user_id);

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
        //just debug message
        $data = [
            'code' => 200,
            'status' => 'success',
            'approver' => $approver,
            'aprobedemailsUpadte' => $aprobedEmailUpdate
        ];

        /*         if($aprobedEmailUpdate){
            $data = [
                'code' => 200,
                'status' => 'success',
                'user' => $request,
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Hubo un error al actualizar'
            ];
        } */
        //return debug
        return response()->json($data, $data['code']);

        //return;
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user->role_id === 1) {
            $emails = AprobedEmail::latest()->take(10)->get()->load('user');
        } else {
            $emails = AprobedEmail::latest()->where('user_id', $id)->take(10)->get();
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'user' => $user,
            'links' => $emails
        ];

        return response()->json($data, $data['code']);;
    }

    public function delete($id){
        return AprobedEmail::destroy($id);
    }

    public function changeStatus($id){
        $link = AprobedEmail::find($id);
        $link->aprobed = 0;
        $link->approver = '';
        $link->save();

        $data = [
            'code' => 200,
            'status' => 'success',
            'linkChanger' => $link
        ];

        return response()->json($data, $data['code']);
    }
}
