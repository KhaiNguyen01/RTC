<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class admin_routing_controller extends Controller {
    private $table_admin = "admin";

    public function do_the_routing(){
      if(session("admin_id")){
        return redirect('/admin/dashboard');
      }
      else{
        return view('admin.login');
      }
    }

    public function check_path($path){
      if(session("admin_id")){
        if($path == 'dashboard'){
          return view('admin.dashboard');
        }
        else{
          return view('admin.'.$path);
        }
      }
      else{
        return redirect('/admin');
      }
    }

    public function admin_login(Request $req){

      $input_username = $req->input('username');
      $input_password = $req->input('password');

      $password_check = DB::table($this->table_admin)->select('*')
                                   ->where('usr','=',$input_username)
                                   ->first();

      if($password_check && sha1($input_password) == $password_check->pwd){
        session(['admin_id' => $password_check->id]);
        session(['admin_username' => $password_check->usr]);
        return redirect("/admin");
      }
      else{
        return redirect("/admin")->with('error', 'true');
      }

	}

    public function admin_logout(){
      session()->flush();
      return redirect("/admin");
    }
}
