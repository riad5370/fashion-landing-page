<?php

namespace App\Http\Controllers;

use App\Models\Leadcollect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LeadRegisterController extends Controller
{
    public function RegisterCreate(){
        return view('frontend.leadcollect.register');
    }
    public function RegisterStore(Request $request){
        $data = [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|string|max:255',
            'mobile' => [
                'required',
                'regex:/^(\+?88)?01[3-9]\d{8}$/',
            ],
        ];
        $messages = [
            'mobile.required' => 'The mobile field is required.',
            'mobile.regex' => 'The mobile field format is invalid. Please provide a valid 11 Digit Bangladeshi mobile number.',
        ];
        
        $validateData = $request->validate($data,$messages);
        Leadcollect::create($validateData);
        return Redirect::route('register.done')->withSuccess('Register done');
    }

    public function RegisterDone(){
        return view('frontend.leadcollect.register_success');
    }
}
