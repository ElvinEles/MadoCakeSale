<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;
use DateTime;

class ProductController extends Controller
{

    public function saveproduct(Request $request)
    {


     $product_accepted_dateformat=new DateTime($request->product_accept_date);
     $product_accepted_dateformat->format('Y-m-d H:i');

     $product_recieve_dateformat=new DateTime($request->product_recieve_date);
     $product_recieve_dateformat->format('Y-m-d H:i');




      if ($request->product_section_name==0) {
         session()->put('product_error','Şöbəni seçmədiniz');
       return back();
      }

      if ($request->product_size==0) {
         session()->put('product_error','Ölçü vahidini seçmədiniz');
       return back();
      }

      $product=new Product();
      $product->product_recieve_person=ucwords($request->product_recieve_person);
      $product->product_recieve_date=$product_recieve_dateformat;
      $product->product_custom_name=ucwords($request->product_custom_name);
      $product->product_price=$request->product_price;
      $product->product_kind=$request->product_kind;
      $product->product_size=$request->product_size;
      $product->product_cake_pors=$request->product_cake_pors;
      $product->product_description=$request->product_description;
      $product->product_section_name=DB::table('tbl_user')->where('user_id','=',$request->product_section_name)->first()->user_name;
      $product->product_accept_date=$product_accepted_dateformat;
      $product->product_custom_number=$request->product_custom_number;
      $product->product_advance=$request->product_advance;
      $product->product_kind_other=$request->product_kind_other;
      $product->product_amount=$request->product_amount;


      $image=Input::file('product_photo');

      $validator = Validator::make($request->all(), [
           'product_photo' => 'max:5000',
       ]);

       if ($validator->fails()) {

         session()->put('product_error','Şəkilin ölçüsü 2 mb böyükdür');
         return redirect()->back()->withErrors($validator->errors());
       }else{

        if ($image) {

       $image_name=rand(0,1000000000000000).$image->getClientOriginalName();
       $destination="images";
       $product->product_photo=$destination."/".$image_name;
       $image->move($destination,$image_name);

     }else {

       $product->product_photo="No Photo";

     }
    }

    $result=$product->save();

    if ($result) {
       session()->put('product_error','Şifarişiniz qeydə alındı');
      return back();
    }else{

    }



}

public function changeproduct(Request $request)
{
   $product_id=$request->product_id_modal;

   Product::where('product_id','=',$product_id)->update(['product_recieved'=>1]);

   return back();
}

public function archieveproduct(Request $request)
{
  date_default_timezone_set("Asia/Baku");
  $current_time=date("Y-m-d H:i");
  $product_id=$request->product_id_modalar;

  $resultcheck=DB::table('tbl_archieve')->where('product_id','=',$product_id)->first();

  if ($resultcheck) {
  session()->put('product_filter_arch_check','Bu sifariş artıq arxivlənib');
  return back();
  }else {
     session()->forget('product_filter_arch_check');
    DB::table('tbl_archieve')->insert([
    [
      'product_id'=>$product_id,
      'user_id'=>session()->get('user_id'),
      'user_time'=>$current_time

    ]
    ]);

   Product::where('product_id','=',$product_id)->update(['product_achieve'=>1]);

   return back();
  }

}
}
