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

        $rulesds = [];

        try {
            $rulesds = Curl::to('https://sodds-app.herokuapp.com/api/v1/rule/get-all-rule')
            ->asJson()
            ->get();

            $rulesds = $rulesds->data;
        }catch(Exception $e) {
            $rulesds = [];
        }

        return view('admin.content.manage-rulesds', compact('rulesds'));
    }

    public function manageRulescf() {
        if(!Session::get('loginAdmin')) {
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }

        $rulescf = [];

        try {
            $rulescf = Curl::to('https://sodds-app.herokuapp.com/api/v1/rulecf/get-all-rule')
            ->asJson()
            ->get();

            $rulescf = $rulescf->data;
        }catch(Exception $e) {
            $rulescf = [];
        }

        return view('admin.content.manage-rulescf', compact('rulescf'));
    }
}
