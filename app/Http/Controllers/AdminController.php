<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Ixudra\Curl\Facades\Curl;

class AdminController extends Controller
{
    public function loginIndex(){
        if(! Session::get('loginAdmin')){
            $admin = Admin::get();
            if($admin->count() < 1){
                $adm = new Admin;
                $adm->username = "admin";
                $adm->password = "admin123";
                $adm->name = "Default Admin";
                $adm->save();
            }

            return view('admin.content.login');
        }else{
            return redirect('/admin/dashboard')->with('alert-warning', 'You are still in your session!');
        }
    }

    //Login process
    public function loginProcess(Request $request){
        $username = $request->username;
        $password = $request->password;

        $admin = Admin::where('username', $username)->first();

        if($admin){
            if(Hash::check($password, $admin->password)){
                Session::put('loginAdmin', Hash::make($username));
                Session::put('username', $username);
                Session::put('name', $admin->name);
                return redirect('/admin/dashboard')->with('alert-success', 'Login success!');
            }else{
                return redirect()->back()->with('alert-danger', 'Wrong password!');
            }
        }else{
            return redirect()->back()->with('alert-danger', 'Wrong username!');
        }
    }

    //Logout
    public function logout(){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }else{
            Session::forget('loginAdmin');
            Session::forget('username');
            return redirect('/admin/login')->with('alert-danger', 'Logout success!');
        }
    }

    //Dasboard Index
    public function dashboard(){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'You must login firstly!');
        }else{
            $evidences = Curl::to('https://sodds-app.herokuapp.com/api/v1/evidence/get-all-evidence')
            ->asJson()
            ->get();

            $evidences = $evidences->data;

            $diseases = Curl::to('https://sodds-app.herokuapp.com/api/v1/disease/get-all-disease')
            ->asJson()
            ->get();

            $diseases = $diseases->data;

            $diagds = Curl::to('https://sodds-app.herokuapp.com/api/v1/diagnosys/get-all-diagds')
            ->asJson()
            ->get();

            $diagds = $diagds->data;

            $diagcf = Curl::to('https://sodds-app.herokuapp.com/api/v1/diagnosys/get-all-diagcf')
            ->asJson()
            ->get();

            $diagcf = $diagcf->data;

            return view('admin.content.dashboard', compact('evidences', 'diseases', 'diagds', 'diagcf'));
        }
    }
}
