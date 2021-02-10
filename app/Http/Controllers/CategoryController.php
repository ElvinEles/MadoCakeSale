<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function save_category(Request $request)
    {
      $result=DB::table('tbl_category')->insert([
        ['category_name'=>$request->category_name]
      ]);

      if ($result) {
      session()->put('category_name_notification','Kateqoriya əlavə edildi');
      }else {
        session()->put('category_name_notification','Kateqoriya əlavə edilmədi');
      }

      return back();
    }

    public function delete_category(Request $request)
    {

       if ($request->category_id==0) {
        session()->put('category_name_notification_delete','Kateqoriya seçmədiniz');
         return back();
       }

      $result=DB::table('tbl_category')->where([
        ['category_id','=',$request->category_id]
      ])->delete();

      if ($result) {
      session()->put('category_name_notification_delete','Kateqoriya silindi');
    }else {
      session()->put('category_name_notification_delete','Kateqoriya silinmədi');
    }

      return back();
    }


    public function update_category(Request $request)
    {

       if ($request->category_id==0) {
        session()->put('category_name_notification_update','Kateqoriya seçmədiniz');
         return back();
       }

      $result=DB::table('tbl_category')
            ->where('category_id','=',$request->category_id)
            ->update(['category_name'=>$request->category_name]);

      if ($result) {
      session()->put('category_name_notification_update','Kateqoriya yeniləndi');
    }else {
      session()->put('category_name_notification_update','Kateqoriya yenilənmədi');
    }

      return back();
    }
}
