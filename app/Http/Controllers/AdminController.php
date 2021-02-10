<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AdminController extends Controller
{
    public function admin_category()
    {
      $categories=DB::table('tbl_category')->get();
      return view('admin.admin_category')->with('categories',$categories);
    }

    public function admin_statistic()
    {
      $products=DB::table('tbl_product')
                ->where('product_achieve','=',5)
                ->select('tbl_product.*')
                ->paginate(25);
       return view('admin.admin_statistic')->with('products',$products);
    }

    public function admin_message()
    {
       return view('admin.admin_message');
    }

    public function update_message(Request $request)
    {
      $message=$request->message;

      if ($message ==null || $message == "") {
        $message =="";
      }

      $result=DB::table('tbl_message')
              ->where('message_id','=',1)
              ->update(['message'=>$message]);

              if ($result) {

                session()->put('message_name_notification','Mesajınız yeniləndi');

              }

      return back();

    }
}
