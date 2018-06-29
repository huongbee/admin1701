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
        //$products = PageUrl::with('categories','categories.products')
        //             ->where('url',$url)
        //             ->first();
        $pageUrl=PageUrl::with('categories')
                    ->where('url',$url)
                    ->first();
        $products =  Products::where('id_type',$pageUrl->categories->id)
                    ->orderBy('id','DESC')
                    ->paginate(10);
        //dd($products);
        return view('list-product',compact('products','pageUrl'));
    }
    function getEditProductByType(Request $req){
        $id = $req->id;
        $product = Products::where('id',$id)->first();
        //$type = \DB::select('SELECT * FROM categories WHERE id IN (SELECT DISTINCT id_type FROM `products`)');
        $type = Categories::all();
        //dd($product);
        return view('edit-product',compact('product','type'));
    }   
    function postEditProductByType(Request $req){
        $product = Products::where('id',$req->id)->first();
        if($product){
            //update
            $product->id_type = $req->id_type;
            $product->name = $req->name;
            $product->detail = $req->detail;
            $product->price = $req->price;
            $product->promotion_price = $req->promotion_price;
            $product->promotion = $req->promotion;
            $product->status = $req->status == 1? 1:0;
            $product->new = $req->new == 1? 1:0;

            //image
            if($req->hasFile('image')){
                $file = $req->file('image');
                $name = time().$file->getClientOriginalName();
                $file->move('admin-master/images/products/',$name);

                $product->image = $name;
            }
            $product->save();

            //update url
            $pageUrl = PageUrl::where('id',$product->id_url)->first();
            $pageUrl->url = (new \App\Helpers\Helpers)->changeTitle($product->name);
            $pageUrl->save();

            $typeUrl = Categories::with('pageUrl')->where('id',$product->id_type)->first();
             
            return redirect()->route('listproduct',$typeUrl->pageUrl->url)->with('success','Cập nhật thành công');

        }
        else{
            return redirect()->back()->with('error','Không tìm thấy sản phẩm');
        }
    }

    function getAddProduct(){
        $type = Categories::all();
        return view('add',compact('type'));
    }
    function postAddProductByType(Request $req){
        //update url
        $pageUrl = new PageUrl;
        $pageUrl->url = (new \App\Helpers\Helpers)->changeTitle($req->name);
        $pageUrl->save();

        $product = new Products;
        $product->id_type = $req->id_type;
        $product->id_url = $pageUrl->id;
        $product->name = $req->name;
        $product->detail = $req->detail;
        $product->price = $req->price;
        $product->promotion_price = $req->promotion_price;
        $product->promotion = $req->promotion;
        $product->status = $req->status == 1? 1:0;
        $product->new = $req->new == 1? 1:0;

        $file = $req->file('image');
        $name = time().$file->getClientOriginalName();
        $file->move('admin-master/images/products/',$name);

        $product->image = $name;
        $product->save();

        $typeUrl = Categories::with('pageUrl')->where('id',$product->id_type)->first();
            
        return redirect()->route('listproduct',$typeUrl->pageUrl->url)->with('success','Thêm mới thành công');
       
    }

    
}
