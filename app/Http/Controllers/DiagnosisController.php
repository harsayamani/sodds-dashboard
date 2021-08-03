<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ixudra\Curl\Facades\Curl;

class DiagnosisController extends Controller
{
    public function diagnosisTest() {
        if(! Session::get('loginAdmin')) {
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

        return view('admin.content.diagnosis-test', compact('evidences'));
    }

    public function diagnosiscfProcess(Request $request) {
        if(! Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $diagnosis = Curl::to('https://sodds-app.herokuapp.com/api/v1/diagnosys/diagcf/confidence-level')
        ->withOption('USERPWD', 'sodds:12345678')
        ->withData( ['disease' => $request->disease, 'usercf' => $request->usercf] )
        ->asJson()
        ->post();

        if($diagnosis->err == false) {
            return response()->json($diagnosis, 200);
        }else {
            return response()->json($diagnosis, 404);
        }
    }

    public function diagnosisProcess(Request $request) {
        if(! Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $diagnosis = Curl::to('https://sodds-app.herokuapp.com/api/v1/diagnosys/diagds')
        ->withOption('USERPWD', 'sodds:12345678')
        ->withData( ['evidences' => $request->evidences] )
        ->asJson()
        ->post();

        if($diagnosis->err == false) {
            $diagnosis = $diagnosis->data;
            $maxBel = $diagnosis->max_bel;
            $maxBelWeight = $diagnosis->max_bel_weight;

            $disease = Curl::to('https://sodds-app.herokuapp.com/api/v1/disease/'.$maxBel)
            ->withOption('USERPWD', 'sodds:12345678')
            ->asJson()
            ->get();

            $disease = $disease->data;

            $rulesCF = Curl::to('https://sodds-app.herokuapp.com/api/v1/rulecf/get-by-disease/'.$maxBel)
            ->withOption('USERPWD', 'sodds:12345678')
            ->asJson()
            ->get();

            return response()->json([
                'disease' => $disease->disease,
                'code' => $maxBel,
                'weight' => $maxBelWeight,
                'rulescf' => $rulesCF->data,
            ], 200);
        }
    }

    public function diagnosisProcess2(Request $request) {
        if(! Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $diagnosis = Curl::to('https://sodds-app.herokuapp.com/api/v1/diagnosys/diagcf')
        ->withOption('USERPWD', 'sodds:12345678')
        ->withData( ['evidences' => $request->evidences] )
        ->asJson()
        ->post();

        if($diagnosis->err == false) {
            $diagnosis = $diagnosis->data;

            return response()->json($diagnosis, 200);
        }
    }

    public function getEvidence(Request $request) {
        if(! Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $evcode = $request->evcode;

        $evidence = Curl::to('https://sodds-app.herokuapp.com/api/v1/evidence/'.$evcode)
        ->withOption('USERPWD', 'sodds:12345678')
        ->asJson()
        ->get();

        if($evidence->err == false) {
            return response()->json($evidence, 200);
        } else {
            return response()->json($evidence, 404);
        }
    }

    public function getDisease(Request $request) {
        if(! Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $discode = $request->discode;

        $disease = Curl::to('https://sodds-app.herokuapp.com/api/v1/disease/'.$discode)
        ->withOption('USERPWD', 'sodds:12345678')
        ->asJson()
        ->get();

        if($disease->err == false) {
            return response()->json($disease, 200);
        } else {
            return response()->json($disease, 404);
        }
    }

    public function diagnosisHistory() {
        if(! Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $diagds_history = [];
        $diagcf_history = [];

        $diagds = Curl::to('https://sodds-app.herokuapp.com/api/v1/diagnosys/get-all-diagds')
        ->withOption('USERPWD', 'sodds:12345678')
        ->asJson()
        ->get();

        $diagcf = Curl::to('https://sodds-app.herokuapp.com/api/v1/diagnosys/get-all-diagcf')
        ->withOption('USERPWD', 'sodds:12345678')
        ->asJson()
        ->get();

        if($diagds->err == false) {
            $diagds_history = $diagds->data;
        }

        if($diagcf->err == false) {
            $diagcf_history = $diagcf->data;
        }

        return view('admin.content.diagnosis-history', compact('diagds_history', 'diagcf_history'));
    }

    public function diagDSHistory() {
        if(! Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $diagds_history = [];

        $diagds = Curl::to('https://sodds-app.herokuapp.com/api/v1/diagnosys/get-all-diagds')
        ->withOption('USERPWD', 'sodds:12345678')
        ->asJson()
        ->get();

        if($diagds->err == false) {
            $diagds_history = $diagds->data;
        }

        return response()->json($diagds_history, 200);
    }

    public function diagCFHistory() {
        if(! Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $diagcf_history = [];

        $diagcf = Curl::to('https://sodds-app.herokuapp.com/api/v1/diagnosys/get-all-diagcf')
        ->withOption('USERPWD', 'sodds:12345678')
        ->asJson()
        ->get();

        if($diagcf->err == false) {
            $diagcf_history = $diagcf->data;
        }

        return response()->json($diagcf_history, 200);
    }

}
