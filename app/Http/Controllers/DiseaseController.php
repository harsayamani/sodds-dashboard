<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ixudra\Curl\Facades\Curl;

class DiseaseController extends Controller
{
    public function manageDisease() {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $diseases = Curl::to('https://sodds-app.herokuapp.com/api/v1/disease/get-all-disease')
        ->asJson()
        ->get();

        if($diseases->err) {
            $diseases = [];
        }else {
            $diseases = $diseases->data;
        }

        return view('admin.content.manage-disease', compact('diseases'));
    }

    public function addDisease(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $diseases = Curl::to('https://sodds-app.herokuapp.com/api/v1/disease/get-all-disease')
        ->asJson()
        ->get();

        if($diseases->err) {
            $diseases = [];
        }else {
            $diseases = $diseases->data;
        }

        $alphabet = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        if(count($diseases) == count($alphabet)) {
            return \redirect()->back()->with('alert-danger', 'The number of diseases exceeds the maximum limit');
        }

        $code = $alphabet[count($diseases)];
        $disease = $request->disease;
        $desc = $request->desc;
        $treatment = $request->treatment;

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/disease/add')
        ->withData( ['code' => $code, 'disease' => $disease, 'desc' => $desc, 'treatment' => $treatment] )
        ->asJson()
        ->post();


        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }

    public function updateDisease(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $id = $request->id;
        $code = $request->code;
        $disease = $request->disease;
        $desc = $request->desc;
        $treatment = $request->treatment;

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/disease/update/'.$id)
        ->withData( ['code' => $code, 'disease' => $disease, 'desc' => $desc, 'treatment' => $treatment] )
        ->asJson()
        ->put();


        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }

    public function deleteDisease(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $id = $request->id;

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/disease/delete/'.$id)
        ->asJson()
        ->delete();


        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }
}
