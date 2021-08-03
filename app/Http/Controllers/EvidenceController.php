<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ixudra\Curl\Facades\Curl;

class EvidenceController extends Controller
{
    public function manageEvidence() {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $evidences = Curl::to('https://sodds-app.herokuapp.com/api/v1/evidence/get-all-evidence')
        ->withOption('USERPWD', 'sodds:12345678')
        ->asJson()
        ->get();

        if($evidences->err) {
            $evidences = [];
        }else {
            $evidences = $evidences->data;
        }

        return view('admin.content.manage-evidence', compact('evidences'));
    }

    public function addEvidence(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $evidences = Curl::to('https://sodds-app.herokuapp.com/api/v1/evidence/get-all-evidence')
        ->withOption('USERPWD', 'sodds:12345678')
        ->asJson()
        ->get();

        if($evidences->err) {
            $evidences = [];
        }else {
            $evidences = $evidences->data;
        }

        $code = 'G'.(count($evidences)+1);
        $evidence = $request->evidence;

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/evidence/add-evidence')
        ->withOption('USERPWD', 'sodds:12345678')
        ->withData( ['code' => $code, 'evidence' => $evidence] )
        ->asJson()
        ->post();


        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }

    public function updateEvidence(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $id = $request->id;
        $code = $request->code;
        $evidence = $request->evidence;

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/evidence/update/'.$id)
        ->withOption('USERPWD', 'sodds:12345678')
        ->withData( ['code' => $code, 'evidence' => $evidence] )
        ->asJson()
        ->put();


        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }

    public function deleteEvidence(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $id = $request->id;

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/evidence/delete/'.$id)
        ->withOption('USERPWD', 'sodds:12345678')
        ->asJson()
        ->delete();


        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }
}
