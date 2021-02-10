<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use DateTime;

class ArchieveFilterController extends Controller
{


    public function filterallproducts(Request $request)
    {


            $product_id_filter=$request->product_id_filter_arch;

            if ($product_id_filter !=null && $product_id_filter != "") {

              $products=Product::where([
                ['product_achieve','=',1],
                ['product_id','=',$product_id_filter]
               ])->get();



             return view('include/archieveproducts')->with('products',$products);
            }

            if ($request->product_accepted_date_fitler_arch == 0 || $request->product_received_date_fitler_arch ==0) {
                 session()->put('product_filter_date_arch','Axtarış üçün tarix seçilməlidir');
             return back();
            }


              session()->forget('product_filter_date');

            $product_accepted_date_fitler=new DateTime($request->product_accepted_date_fitler_arch);
            $product_accepted_date_fitler->format('Y-m-d H:i');
            $product_received_date_fitler=new DateTime($request->product_received_date_fitler_arch);
            $product_received_date_fitler->format('Y-m-d H:i');
            $product_received_person_fitler=$request->product_received_person_fitler_arch;
            $product_kind_or_other_value=$request->product_kind_or_other_value_arch;
            $product_amount_value=$request->product_amount_value_arch;





            if ($product_received_person_fitler !=null && $product_received_person_fitler != "" &&
               $product_kind_or_other_value !=null && $product_kind_or_other_value != "" &&
                $product_amount_value !=null && $product_amount_value != ""
              ) {


              $result=DB::table('tbl_category')->where('category_name','like','%'.$product_kind_or_other_value.'%')->first();

              if ($result) {

                $products=DB::table('tbl_product')
                ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
                ->join('tbl_category','category_id','=','tbl_product.product_kind')
                ->where([
                  ['product_achieve','=',1],
                  ['product_accept_date','>',$product_accepted_date_fitler],
                  ['product_recieve_date','<',$product_received_date_fitler],
                  ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
                  ['category_name','like','%'.$product_kind_or_other_value.'%'],
                  ['product_cake_pors','like','%'.$product_amount_value.'%']
                  ])->orWhere([
                    ['product_achieve','=',1],
                    ['product_accept_date','>',$product_accepted_date_fitler],
                    ['product_recieve_date','<',$product_received_date_fitler],
                    ['product_section_name','like','%'.$product_received_person_fitler.'%'],
                    ['category_name','like','%'.$product_kind_or_other_value.'%'],
                    ['product_cake_pors','like','%'.$product_amount_value.'%']
                  ])->orderBy('user_time','desc')
                  ->get();



               return view('include/archieveproducts')->with('products',$products);

             }else {
               $products=DB::table('tbl_product')
               ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
               ->where([
                 ['product_achieve','=',1],
                 ['product_accept_date','>',$product_accepted_date_fitler],
                 ['product_recieve_date','<',$product_received_date_fitler],
                 ['product_section_name','like','%'.$product_received_person_fitler.'%'],
                 ['product_kind_other','like','%'.$product_kind_or_other_value.'%'],
                 ['product_amount','like','%'.$product_amount_value.'%']
               ])->orWhere([
                 ['product_achieve','=',1],
                 ['product_accept_date','>',$product_accepted_date_fitler],
                 ['product_recieve_date','<',$product_received_date_fitler],
                 ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
                 ['product_kind_other','like','%'.$product_kind_or_other_value.'%'],
                 ['product_amount','like','%'.$product_amount_value.'%']
               ])->orderBy('user_time','desc')
               ->get();



          return view('include/archieveproducts')->with('products',$products);

             }
            }



            if ($product_received_person_fitler !=null && $product_received_person_fitler != "" &&
               $product_amount_value !=null && $product_amount_value != "" &&
                $product_kind_or_other_value ==null && $product_kind_or_other_value == ""
              ) {



              $products=DB::table('tbl_product')
              ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
              ->where([
                ['product_achieve','=',1],
                ['product_accept_date','>',$product_accepted_date_fitler],
                ['product_recieve_date','<',$product_received_date_fitler],
                ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
                ['product_amount','like','%'.$product_amount_value.'%']
                ])->orWhere([
                  ['product_achieve','=',1],
                  ['product_accept_date','>',$product_accepted_date_fitler],
                  ['product_recieve_date','<',$product_received_date_fitler],
                  ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
                  ['product_cake_pors','like','%'.$product_amount_value.'%']
                ])->orWhere([
                  ['product_achieve','=',1],
                  ['product_accept_date','>',$product_accepted_date_fitler],
                  ['product_recieve_date','<',$product_received_date_fitler],
                  ['product_section_name','like','%'.$product_received_person_fitler.'%'],
                  ['product_cake_pors','like','%'.$product_amount_value.'%']
                ])->orWhere([
                  ['product_achieve','=',1],
                  ['product_accept_date','>',$product_accepted_date_fitler],
                  ['product_recieve_date','<',$product_received_date_fitler],
                  ['product_section_name','like','%'.$product_received_person_fitler.'%'],
                  ['product_amount','like','%'.$product_amount_value.'%']
                ])->orderBy('user_time','desc')
                ->get();



            return view('include/archieveproducts')->with('products',$products);
            }



            if ($product_received_person_fitler !=null && $product_received_person_fitler != "" &&
               $product_kind_or_other_value !=null && $product_kind_or_other_value != "" &&
                $product_amount_value ==null && $product_amount_value == ""

              ) {

                $result=DB::table('tbl_category')->where('category_name','like','%'.$product_kind_or_other_value.'%')->first();

                if ($result) {

                  $products=DB::table('tbl_product')
                  ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
                  ->join('tbl_category','category_id','=','tbl_product.product_kind')
                  ->where([
                    ['product_achieve','=',1],
                    ['product_accept_date','>',$product_accepted_date_fitler],
                    ['product_recieve_date','<',$product_received_date_fitler],
                    ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
                    ['category_name','like','%'.$product_kind_or_other_value.'%']
                    ])->orWhere([
                      ['product_achieve','=',1],
                      ['product_accept_date','>',$product_accepted_date_fitler],
                      ['product_recieve_date','<',$product_received_date_fitler],
                      ['product_section_name','like','%'.$product_received_person_fitler.'%'],
                      ['category_name','like','%'.$product_kind_or_other_value.'%']
                      ])->orderBy('user_time','desc')
                      ->get();



                    return view('include/archieveproducts')->with('products',$products);


                }else{


              $products=DB::table('tbl_product')
              ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
              ->where([
                  ['product_achieve','=',1],
                  ['product_accept_date','>',$product_accepted_date_fitler],
                  ['product_recieve_date','<',$product_received_date_fitler],
                  ['product_section_name','like','%'.$product_received_person_fitler.'%'],
                  ['product_kind_other','like','%'.$product_kind_or_other_value.'%']
                ])->orWhere([
                  ['product_achieve','=',1],
                  ['product_accept_date','>',$product_accepted_date_fitler],
                  ['product_recieve_date','<',$product_received_date_fitler],
                  ['product_recieve_person','like','%'.$product_received_person_fitler.'%'],
                  ['product_kind_other','like','%'.$product_kind_or_other_value.'%']
                ])->orderBy('user_time','desc')
                ->get();



             return view('include/archieveproducts')->with('products',$products);
           }
            }


            if ($product_amount_value !=null && $product_amount_value != "" &&
               $product_kind_or_other_value !=null && $product_kind_or_other_value != "" &&
               $product_received_person_fitler ==null && $product_received_person_fitler == ""

              ) {

                $result=DB::table('tbl_category')->where('category_name','like','%'.$product_kind_or_other_value.'%')->first();

                if ($result) {
                  $products=DB::table('tbl_product')
                  ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
                  ->join('tbl_category','category_id','=','tbl_product.product_kind')
                  ->where([
                    ['product_achieve','=',1],
                    ['product_accept_date','>',$product_accepted_date_fitler],
                    ['product_recieve_date','<',$product_received_date_fitler],
                    ['product_cake_pors','like','%'.$product_amount_value.'%'],
                    ['category_name','like','%'.$product_kind_or_other_value.'%']
                    ])->orderBy('user_time','desc')
                    ->get();



                   return view('include/archieveproducts')->with('products',$products);
                }else{

              $products=DB::table('tbl_product')
              ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
              ->where([
                  ['product_achieve','=',1],
                  ['product_accept_date','>',$product_accepted_date_fitler],
                  ['product_recieve_date','<',$product_received_date_fitler],
                  ['product_amount','like','%'.$product_amount_value.'%'],
                  ['product_kind_other','like','%'.$product_kind_or_other_value.'%']
                ])->orderBy('user_time','desc')
              ->get();



             return view('include/archieveproducts')->with('products',$products);
           }
            }


            if ($product_received_person_fitler !=null && $product_received_person_fitler != "" &&
            $product_kind_or_other_value ==null && $product_kind_or_other_value == "" &&
             $product_amount_value ==null && $product_amount_value == ""
          ) {



              $products=DB::table('tbl_product')
              ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
              ->where([
                ['product_achieve','=',1],
                ['product_accept_date','>',$product_accepted_date_fitler],
                ['product_recieve_date','<',$product_received_date_fitler],
                ['product_recieve_person','like','%'.$product_received_person_fitler.'%']
                ])
                ->orWhere([
                  ['product_achieve','=',1],
                  ['product_accept_date','>',$product_accepted_date_fitler],
                  ['product_recieve_date','<',$product_received_date_fitler],
                  ['product_section_name','like','%'.$product_received_person_fitler.'%']
                ])->orderBy('user_time','desc')
              ->get();



             return view('include/archieveproducts')->with('products',$products);
            }



            if ($product_kind_or_other_value !=null && $product_kind_or_other_value != "" &&
               $product_received_person_fitler ==null && $product_received_person_fitler == "" &&
               $product_amount_value ==null && $product_amount_value == ""
          ) {


               $result=DB::table('tbl_category')->where('category_name','like','%'.$product_kind_or_other_value.'%')->first();

               if ($result) {
                 $products=DB::table('tbl_product')
                 ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
                 ->join('tbl_category','category_id','=','tbl_product.product_kind')
                 ->where([
                   ['product_achieve','=',1],
                   ['product_accept_date','>',$product_accepted_date_fitler],
                   ['product_recieve_date','<',$product_received_date_fitler],
                   ['category_name','like','%'.$product_kind_or_other_value.'%']
                   ])->orderBy('user_time','desc')
                   ->get();



                  return view('include/archieveproducts')->with('products',$products);
               }else{
              $products=DB::table('tbl_product')
                 ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
              ->where([
                  ['product_achieve','=',1],
                  ['product_accept_date','>',$product_accepted_date_fitler],
                  ['product_recieve_date','<',$product_received_date_fitler],
                  ['product_kind_other','like','%'.$product_kind_or_other_value.'%']
                ])->orderBy('user_time','desc')
                ->get();



             return view('include/archieveproducts')->with('products',$products);
           }
            }


            if ($product_kind_or_other_value ==null && $product_kind_or_other_value == "" &&
               $product_received_person_fitler ==null && $product_received_person_fitler == "" &&
               $product_amount_value !=null && $product_amount_value != "") {

                 $products=DB::table('tbl_product')
                 ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
                 ->where([
                     ['product_achieve','=',1],
                     ['product_accept_date','>',$product_accepted_date_fitler],
                     ['product_recieve_date','<',$product_received_date_fitler],
                     ['product_cake_pors','like','%'.$product_amount_value.'%']
                   ])->orWhere([
                     ['product_achieve','=',1],
                     ['product_accept_date','>',$product_accepted_date_fitler],
                     ['product_recieve_date','<',$product_received_date_fitler],
                     ['product_amount','like','%'.$product_amount_value.'%']
                   ])->orderBy('user_time','desc')
                   ->get();


                return view('include/archieveproducts')->with('products',$products);


            }

            if ($product_kind_or_other_value ==null && $product_kind_or_other_value == "" &&
               $product_received_person_fitler ==null && $product_received_person_fitler == "" &&
               $product_amount_value ==null && $product_amount_value == "") {

                 $products=DB::table('tbl_product')
                 ->join('tbl_archieve','tbl_archieve.product_id','=','tbl_product.product_id')
                 ->where([
                     ['product_achieve','=',1],
                     ['product_accept_date','>',$product_accepted_date_fitler],
                     ['product_recieve_date','<',$product_received_date_fitler]
                   ])->orderBy('user_time','desc')
                   ->get();


                return view('include/archieveproducts')->with('products',$products);


            }

             return redirect('/archieveproducts');

          }

}
