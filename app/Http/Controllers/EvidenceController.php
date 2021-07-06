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

        $evidences = [];

        try {
            $evidences = Curl::to('https://sodds-app.herokuapp.com/api/v1/evidence/get-all-evidence')
            ->asJson()
            ->get();

            $evidences = $evidences->data;
        }catch(Exception $e) {
            $evidences = [];
        }

        return view('admin.content.manage-evidence', compact('evidences'));
    }
}
