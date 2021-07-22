<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ixudra\Curl\Facades\Curl;

class RulesController extends Controller
{
    public function manageRulesds() {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $rulesds = Curl::to('https://sodds-app.herokuapp.com/api/v1/rule/get-all-rule')
        ->asJson()
        ->get();

        if($rulesds->err) {
            $rulesds = [];
        }else{
            $rulesds = $rulesds->data;
        }

        $evidences = Curl::to('https://sodds-app.herokuapp.com/api/v1/evidence/get-all-evidence')
        ->asJson()
        ->get();

        if($evidences->err) {
            $evidences = [];
        }else {
            $evidences = $evidences->data;
        }

        $diseases = Curl::to('https://sodds-app.herokuapp.com/api/v1/disease/get-all-disease')
        ->asJson()
        ->get();

        if($diseases->err) {
            $diseases = [];
        }else {
            $diseases = $diseases->data;
        }

        return view('admin.content.manage-rulesds', compact('rulesds', 'diseases', 'evidences'));
    }

    public function manageRulescf() {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $rulescf = Curl::to('https://sodds-app.herokuapp.com/api/v1/rulecf/get-all-rule')
        ->asJson()
        ->get();

        if($rulescf->err) {
            $rulesds = [];
        }else{
            $rulescf = $rulescf->data;
        }

        $evidences = Curl::to('https://sodds-app.herokuapp.com/api/v1/evidence/get-all-evidence')
        ->asJson()
        ->get();

        if($evidences->err) {
            $evidences = [];
        }else {
            $evidences = $evidences->data;
        }

        $diseases = Curl::to('https://sodds-app.herokuapp.com/api/v1/disease/get-all-disease')
        ->asJson()
        ->get();

        if($diseases->err) {
            $diseases = [];
        }else {
            $diseases = $diseases->data;
        }

        $cfvalues = Curl::to('https://sodds-app.herokuapp.com/api/v1/certainty-value/get-all-certainty')
        ->asJson()
        ->get();

        if($cfvalues->err) {
            $cfvalues = [];
        }else {
            $cfvalues = $cfvalues->data;
        }

        return view('admin.content.manage-rulescf', compact('rulescf', 'diseases', 'evidences', 'diseases', 'cfvalues'));
    }

    public function addRulesDS(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $evcode = $request->evcode;
        $discodes = $request->discodes;
        $belief = $request->belief;
        $discode = '';

        for($i=0; $i<count($discodes); $i++) {
            $discode .= $discodes[$i];
        }

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/rule/add')
        ->withData( ['evcode' => $evcode, 'discode' => $discode, 'belief' => floatval($belief)] )
        ->asJson()
        ->post();

        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }

    public function updateRulesDS(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $id = $request->id;
        $evcode = $request->evcode;
        $discodes = $request->discodes;
        $belief = $request->belief;
        $discode = '';

        for($i=0; $i<count($discodes); $i++) {
            $discode .= $discodes[$i];
        }

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/rule/update/'.$id)
        ->withData( ['evcode' => $evcode, 'discode' => $discode, 'belief' => floatval($belief)] )
        ->asJson()
        ->put();


        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }

    public function deleteRulesDS(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $id = $request->id;

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/rule/delete/'.$id)
        ->asJson()
        ->delete();


        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }

    public function addRulesCF(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $evcode = $request->evcode;
        $discode = $request->discode;
        $cfvalcode = $request->cfvalcode;

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/rulecf/add')
        ->withData( ['evcode' => $evcode, 'discode' => $discode, 'cfvalcode' => $cfvalcode] )
        ->asJson()
        ->post();

        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }

    public function updateRulesCF(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $id = $request->id;
        $evcode = $request->evcode;
        $discode = $request->discode;
        $cfvalcode = $request->cfvalcode;

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/rulecf/update/'.$id)
        ->withData( ['evcode' => $evcode, 'discode' => $discode, 'cfvalcode' => $cfvalcode] )
        ->asJson()
        ->put();


        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }

    public function deleteRulesCF(Request $request) {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $id = $request->id;

        $result = Curl::to('https://sodds-app.herokuapp.com/api/v1/rulecf/delete/'.$id)
        ->asJson()
        ->delete();


        if($result->err){
            return \redirect()->back()->with('alert-danger', $result->message);
        }

        return \redirect()->back()->with('alert-success', $result->message);
    }
}
