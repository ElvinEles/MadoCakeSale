<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;


class HomeController extends Controller
{
    public function index()
    {

      $allusers=DB::table('tbl_user')->get();

      return view('login')->with('allusers',$allusers);
    }

    public function product_order()
    {
      return view('include/product_order');
    }

    public function allproducts()
    {

        session()->forget('product_filter');

        $products=Product::where('product_achieve',0)->orderBy('product_recieve_date','asc')->get();
        return view('include/allproducts')->with('products',$products);
    }

    public function archieveproducts()
    {
        $products=DB::table('tbl_product')
                 ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
                 ->where('product_achieve',1)
                 ->orderBy('user_time','desc')
                 ->select('tbl_product.*','tbl_archieve.user_id','tbl_archieve.user_time')
                 ->limit(100)
                ->get();
        return view('include/archieveproducts')->with('products',$products);
    }

    public function show_product($id)
    {
        $product=Product::where('product_id','=',$id)->first();
       return view('include.show_product')->with('product',$product);

    }

    public function logincheck(Request $request)
    {

      if ($request->user_id==0) {
        session()->put('user_error','Useri seçmədiniz!');
        return back();
      }

      $user_id=$request->user_id;
      $user_password=md5($request->user_password);
      $user=DB::table('tbl_user')->where('user_id','=',$user_id)->first();

      if ($user_password == $user->user_password) {

        session()->put('user_id',$user->user_id);
        session()->put('user_name',$user->user_name);

        return redirect('/allproducts');
      }else{
        session()->put('user_error','Parolu yalnış daxil etdiniz!');
        return back();
      }

    }

    public function logout_user()
    {
      session()->forget('user_id');
      session()->forget('user_name');

      return redirect('/index');
    }
}
