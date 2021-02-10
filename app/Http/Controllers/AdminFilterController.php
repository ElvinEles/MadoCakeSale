<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use DateTime;

class AdminFilterController extends Controller
{
  public function filterallproducts(Request $request)
  {



    $product_id_filter=$request->product_id_filter;

    if ($product_id_filter !=null && $product_id_filter != "") {

      $products=Product::where([

        ['product_id','=',$product_id_filter]
       ])->select('tbl_product.*')
        ->get();



     return view('admin/admin_statistic')->with('products',$products);
    }

    if ($request->product_accepted_date_fitler == 0 || $request->product_received_date_fitler ==0) {
         session()->put('product_filter_date','Axtarış üçün tarix seçilməlidir');
     return back();
    }




    $product_accepted_date_fitler=new DateTime($request->product_accepted_date_fitler);
    $product_accepted_date_fitler->format('Y-m-d H:i');
    $product_received_date_fitler=new DateTime($request->product_received_date_fitler);
    $product_received_date_fitler->format('Y-m-d H:i');
    $product_received_person_fitler=$request->product_received_person_fitler;
    $product_kind_or_other_value=$request->product_kind_or_other_value;
    $product_amount_value=$request->product_amount_value;





    if ($product_received_person_fitler !=null && $product_received_person_fitler != "" &&
       $product_kind_or_other_value !=null && $product_kind_or_other_value != "" &&
        $product_amount_value !=null && $product_amount_value != ""
      ) {


      $result=DB::table('tbl_category')->where('category_name','like','%'.$product_kind_or_other_value.'%')->first();

      if ($result) {

        $products=DB::table('tbl_product')
        ->join('tbl_category','category_id','=','tbl_product.product_kind')
        ->where([
          ['product_accept_date','>',$product_accepted_date_fitler],
          ['product_recieve_date','<',$product_received_date_fitler],
          ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
          ['category_name','like','%'.$product_kind_or_other_value.'%'],
          ['product_cake_pors','like','%'.$product_amount_value.'%']
          ])->orWhere([
            ['product_accept_date','>',$product_accepted_date_fitler],
            ['product_recieve_date','<',$product_received_date_fitler],
            ['product_section_name','like','%'.$product_received_person_fitler.'%'],
            ['category_name','like','%'.$product_kind_or_other_value.'%'],
            ['product_cake_pors','like','%'.$product_amount_value.'%']
          ])->orderBy('product_recieve_date','asc')
           ->get();



       return view('admin/admin_statistic')->with('products',$products);

     }else {
       $products=DB::table('tbl_product')
       ->where([
         ['product_accept_date','>',$product_accepted_date_fitler],
         ['product_recieve_date','<',$product_received_date_fitler],
         ['product_section_name','like','%'.$product_received_person_fitler.'%'],
         ['product_kind_other','like','%'.$product_kind_or_other_value.'%'],
         ['product_amount','like','%'.$product_amount_value.'%']
       ])->orWhere([
         ['product_accept_date','>',$product_accepted_date_fitler],
         ['product_recieve_date','<',$product_received_date_fitler],
         ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
         ['product_kind_other','like','%'.$product_kind_or_other_value.'%'],
         ['product_amount','like','%'.$product_amount_value.'%']
       ])->orderBy('product_recieve_date','asc')
      ->get();



     return view('admin/admin_statistic')->with('products',$products);

     }
    }



    if ($product_received_person_fitler !=null && $product_received_person_fitler != "" &&
       $product_amount_value !=null && $product_amount_value != "" &&
        $product_kind_or_other_value ==null && $product_kind_or_other_value == ""
      ) {



      $products=DB::table('tbl_product')
      ->where([
        ['product_accept_date','>',$product_accepted_date_fitler],
        ['product_recieve_date','<',$product_received_date_fitler],
        ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
        ['product_amount','like','%'.$product_amount_value.'%']
        ])->orWhere([
          ['product_accept_date','>',$product_accepted_date_fitler],
          ['product_recieve_date','<',$product_received_date_fitler],
          ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
          ['product_cake_pors','like','%'.$product_amount_value.'%']
        ])->orWhere([
          ['product_accept_date','>',$product_accepted_date_fitler],
          ['product_recieve_date','<',$product_received_date_fitler],
          ['product_section_name','like','%'.$product_received_person_fitler.'%'],
          ['product_cake_pors','like','%'.$product_amount_value.'%']
        ])->orWhere([
          ['product_accept_date','>',$product_accepted_date_fitler],
          ['product_recieve_date','<',$product_received_date_fitler],
          ['product_section_name','like','%'.$product_received_person_fitler.'%'],
          ['product_amount','like','%'.$product_amount_value.'%']
        ])->orderBy('product_recieve_date','asc')
         ->get();



      return view('admin/admin_statistic')->with('products',$products);
    }



    if ($product_received_person_fitler !=null && $product_received_person_fitler != "" &&
       $product_kind_or_other_value !=null && $product_kind_or_other_value != "" &&
        $product_amount_value ==null && $product_amount_value == ""

      ) {

        $result=DB::table('tbl_category')->where('category_name','like','%'.$product_kind_or_other_value.'%')->first();

        if ($result) {

          $products=DB::table('tbl_product')
          ->join('tbl_category','category_id','=','tbl_product.product_kind')
          ->where([
            ['product_accept_date','>',$product_accepted_date_fitler],
            ['product_recieve_date','<',$product_received_date_fitler],
            ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
            ['category_name','like','%'.$product_kind_or_other_value.'%']
            ])->orWhere([
              ['product_accept_date','>',$product_accepted_date_fitler],
              ['product_recieve_date','<',$product_received_date_fitler],
              ['product_section_name','like','%'.$product_received_person_fitler.'%'],
              ['category_name','like','%'.$product_kind_or_other_value.'%']
              ])->orderBy('product_recieve_date','asc')
               ->get();



             return view('admin/admin_statistic')->with('products',$products);


        }else{


      $products=DB::table('tbl_product')
      ->where([
          ['product_accept_date','>',$product_accepted_date_fitler],
          ['product_recieve_date','<',$product_received_date_fitler],
          ['product_section_name','like','%'.$product_received_person_fitler.'%'],
          ['product_kind_other','like','%'.$product_kind_or_other_value.'%']
        ])->orWhere([
          ['product_accept_date','>',$product_accepted_date_fitler],
          ['product_recieve_date','<',$product_received_date_fitler],
          ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
          ['product_kind_other','like','%'.$product_kind_or_other_value.'%']
        ])->orderBy('product_recieve_date','asc')
          ->get();



     return view('admin/admin_statistic')->with('products',$products);
   }
    }


    if ($product_amount_value !=null && $product_amount_value != "" &&
       $product_kind_or_other_value !=null && $product_kind_or_other_value != "" &&
       $product_received_person_fitler ==null && $product_received_person_fitler == ""

      ) {

        $result=DB::table('tbl_category')->where('category_name','like','%'.$product_kind_or_other_value.'%')->first();

        if ($result) {
          $products=DB::table('tbl_product')
          ->join('tbl_category','category_id','=','tbl_product.product_kind')
          ->where([
            ['product_accept_date','>',$product_accepted_date_fitler],
            ['product_recieve_date','<',$product_received_date_fitler],
            ['product_cake_pors','like','%'.$product_amount_value.'%'],
            ['category_name','like','%'.$product_kind_or_other_value.'%']
            ])->orderBy('product_recieve_date','asc')
            ->get();



           return view('admin/admin_statistic')->with('products',$products);
        }else{

      $products=DB::table('tbl_product')
      ->where([
          ['product_accept_date','>',$product_accepted_date_fitler],
          ['product_recieve_date','<',$product_received_date_fitler],
          ['product_amount','like','%'.$product_amount_value.'%'],
          ['product_kind_other','like','%'.$product_kind_or_other_value.'%']
        ])->orderBy('product_recieve_date','asc')
         ->get();


     return view('admin/admin_statistic')->with('products',$products);
   }
    }


    if ($product_received_person_fitler !=null && $product_received_person_fitler != "" &&
    $product_kind_or_other_value ==null && $product_kind_or_other_value == "" &&
     $product_amount_value ==null && $product_amount_value == ""
  ) {



      $products=DB::table('tbl_product')
      ->where([
        ['product_accept_date','>=',$product_accepted_date_fitler],
        ['product_recieve_date','<',$product_received_date_fitler],
        ['product_recieve_person','like','%'.$product_received_person_fitler.'%']
        ])
        ->orWhere([
          ['product_accept_date','>',$product_accepted_date_fitler],
          ['product_recieve_date','<',$product_received_date_fitler],
          ['product_section_name','like','%'.$product_received_person_fitler.'%']
        ])->orderBy('product_recieve_date','asc')
         ->get();


     return view('admin/admin_statistic')->with('products',$products);
    }



    if ($product_kind_or_other_value !=null && $product_kind_or_other_value != "" &&
       $product_received_person_fitler ==null && $product_received_person_fitler == "" &&
       $product_amount_value ==null && $product_amount_value == ""
  ) {


       $result=DB::table('tbl_category')->where('category_name','like','%'.$product_kind_or_other_value.'%')->first();

       if ($result) {
         $products=DB::table('tbl_product')
         ->join('tbl_category','category_id','=','tbl_product.product_kind')
         ->where([
           ['product_accept_date','>',$product_accepted_date_fitler],
           ['product_recieve_date','<',$product_received_date_fitler],
           ['category_name','like','%'.$product_kind_or_other_value.'%']
           ])->orderBy('product_recieve_date','asc')
          ->get();



         return view('admin/admin_statistic')->with('products',$products);
       }else{
      $products=DB::table('tbl_product')
      ->where([
          ['product_accept_date','>',$product_accepted_date_fitler],
          ['product_recieve_date','<',$product_received_date_fitler],
          ['product_kind_other','like','%'.$product_kind_or_other_value.'%']
        ])->orderBy('product_recieve_date','asc')
        ->get();



      return view('admin/admin_statistic')->with('products',$products);
   }
    }


    if ($product_kind_or_other_value ==null && $product_kind_or_other_value == "" &&
       $product_received_person_fitler ==null && $product_received_person_fitler == "" &&
       $product_amount_value !=null && $product_amount_value != "") {

         $products=DB::table('tbl_product')
         ->where([

             ['product_accept_date','>',$product_accepted_date_fitler],
             ['product_recieve_date','<',$product_received_date_fitler],
             ['product_cake_pors','like','%'.$product_amount_value.'%']
           ])->orWhere([

             ['product_accept_date','>',$product_accepted_date_fitler],
             ['product_recieve_date','<',$product_received_date_fitler],
             ['product_amount','like','%'.$product_amount_value.'%']
           ])->orderBy('product_recieve_date','asc')
            ->get();



       return view('admin/admin_statistic')->with('products',$products);


    }

    if ($product_kind_or_other_value ==null && $product_kind_or_other_value == "" &&
       $product_received_person_fitler ==null && $product_received_person_fitler == "" &&
       $product_amount_value ==null && $product_amount_value == "") {

         $products=DB::table('tbl_product')
         ->where([
             ['product_accept_date','>',$product_accepted_date_fitler],
             ['product_recieve_date','<',$product_received_date_fitler],
           ])->select('tbl_product.*')
            ->get();

       return view('admin.admin_statistic')->with('products',$products);


    }




     return redirect('/admin_statistic');

  }
}
