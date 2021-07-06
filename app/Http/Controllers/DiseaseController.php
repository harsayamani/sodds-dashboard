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

        $diseases = [];

        try {
            $diseases = Curl::to('https://sodds-app.herokuapp.com/api/v1/disease/get-all-disease')
            ->asJson()
            ->get();

            $diseases = $diseases->data;
        }catch(Exception $e) {
            $diseases = [];
        }

        return view('admin.content.manage-disease', compact('diseases'));
    }
}
