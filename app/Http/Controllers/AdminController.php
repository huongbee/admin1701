<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Hash;
use Auth;
use App\Bills;
use App\PageUrl;
use App\Categories;
use App\Products;

class AdminController extends Controller
{
    function getLogin(){
        return view('user.login');
    }
    function postLogin(Request $req){
        $data = [
            'email'=>$req->inputEmail,
            'password'=>$req->inputPassword
        ];
        if(Auth::attempt($data)){
            return redirect()
                ->route('home');
        }
        return redirect()->back()
                ->with('error_message','Sai thông tin đăng nhập.');
    }

    function getRegister(){
        return view('user.register');
    }
    function postRegister(Request $req){
        $validator = Validator::make($req->all(), [
            'username' => 'required|unique:users,username|max:50|min:5',
            'fullname' => 'required',
            'birthdate' => "required|date",
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6|max:50',
            'confirm_password' => 'same:password'
        ],[
            'username.unique'=>"Username đã tồn tại",
            'username.min' => 'Username ít nhất :min kí tự',
            'confirm_password.same' => 'Mật khẩu không giống nhau'
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = new User;
        $user->username = $req->username;
        $user->password = Hash::make($req->password);
        $user->fullname = $req->fullname;
        $user->birthdate = $req->birthdate;
        $user->email = $req->email;
        $user->save();
        return redirect()
                ->route('login')
                ->with('success','Đăng kí thành công.');
    }
    
    function logout(){
        Auth::logout();
        return redirect()
                ->route('login');
    }

    function getHome(){
        $chuaXacNhan = Bills::with('products')
                        ->where('status',0)
                        ->orderBy('id','DESC')
                        ->limit(20)
                        ->get();
        $daXacNhan = Bills::with('products')
                        ->where('status',1)
                        ->orderBy('id','DESC')
                        ->limit(20)
                        ->get();
        $daHoantat = Bills::with('products')
                        ->where('status',2)
                        ->orderBy('id','DESC')
                        ->limit(20)
                        ->get();
        
        //dd($chuaXacNhan);
        return view('home',compact('chuaXacNhan','daXacNhan','daHoantat'));
    }
    function getUpdateStatusBill(Request $req){
        $bill = Bills::where('id',$req->id)->first();
        if($bill){
            $bill->status = 2;
            $bill->save();
            echo "true";
        }
        else{
            echo "false";
        }
    }

    function getListProductByType(Request $req){
        $url = $req->alias;
        $products = PageUrl::with('categories','categories.products','categories.products.pageUrlProduct')
                    ->where('url',$url)
                    ->first();
        //dd($products);
        return view('list-product',compact('products'));
    }
    function getEditProductByType(Request $req){
        $id = $req->id;
        $product = Products::where('id',$id)->first();
        return view('edit-product',compact('product'));
    }   

    
}
