@extends('index')

@section('title')
Arxiv Sifarişlər
@endsection

@section('content')
<div class="col-md-12">
  <p style="color:red;background:#fafafa;" class="text-center text-uppercase font-weight-bold">SON 100 ARXİV</p>
  @if(session()->get('product_filter_date_arch') !=null)
  <p style="color:#b71c1c;background:#fafafa;" class="text-center">
    Axtarış üçün tarix seçilməlidir
   <?php
         session()->forget('product_filter_date_arch');
    ?>
  </p>
  @endif

    <!-- DATA TABLE-->
    <div class="single-table">
    <div class="table-responsive">
        <table class="table table-hover progress-table">
            <thead>
                <tr style="font-size:15px;" class="text-center">
                    <th style="width:10px;">ID</th>
                    <th style="width:130px;">Qəbul tarixi</th>
                    <th style="width:130px;">Təslim tarixi</th>
                    <th style="width:140px;">Sifarişi alan</th>
                    <th style="width:140px;">Sifarişi növü</th>
                    <th style="width:90px;">Pors/Digər</th>
                    <th style="width:140px;">Arxivlədi</th>
                    <th style="width:60px;">Action</th>
                </tr>
            </thead>
            <tbody>

              <form  action="{{URL::to('/filterarch')}}" method="post">
                 {{ csrf_field() }}
                <tr>
                  <td><input type="text" id="product_id_value" autocomplete="off" style="font-size:12px;" name="product_id_filter_arch"  class="form-control"/></td>
                  <td>
                    <input id="product_accept_date_value"  autocomplete="off"   name="product_accepted_date_fitler_arch" style="font-size:12px;"  type='text' class="form-control" />
                  </td>
                  <td>
                    <input id="product_recieve_date_value" autocomplete="off"   name="product_received_date_fitler_arch" style="font-size:12px;"  type='text' class="form-control" />
                  </td>
                  <td><input type="text" id="product_recieve_person_value" autocomplete="off" style="font-size:12px;" name="product_received_person_fitler_arch" class="form-control"/></td>
                  <td><input type="text" id="product_kind_or_other_value" autocomplete="off" style="font-size:12px;"  name="product_kind_or_other_value_arch" class="form-control"/></td>
                  <td><input type="text" id="product_amount_value" autocomplete="off" style="font-size:12px;" name="product_amount_value_arch" class="form-control"/></td>

                  <td colspan="2"><input type="submit"  class="btn btn-primary btn-block" value="Axtar"/></td>
                </tr>
              </form>


              @foreach($products as $product)

           <?php
                    $user_id_arch=DB::table('tbl_archieve')->where('product_id','=',$product->product_id)->first();
                    $user_current=DB::table('tbl_user')->where('user_id','=',$user_id_arch->user_id)->first();
                    $product_category=DB::table('tbl_category')->where('category_id','=',$product->product_kind)->first();

            ?>

                <tr  style="font-size:12px;" class="text-center">
                    <td>{{$product->product_id}}</td>
                    <td>
                      <?php
                    $product_accepted_dateformat_arch=new DateTime($product->product_accept_date);
                    echo   $product_accepted_dateformat_arch->format('d.m.Y H:i');
                     ?>
                    </td>
                    <td>
                      <?php
                      $product_recieve_dateformat_arch=new DateTime($product->product_recieve_date);
                      echo   $product_recieve_dateformat_arch->format('d.m.Y H:i');
                       ?>
                    </td>
                    <td>{{substr($product->product_recieve_person." ".$product->product_section_name,0,15)}}</td>
                    <td>
                      @if($product_category !=null)
                      <?php
                        echo $product_category->category_name."".$product->product_kind_other;
                       ?>
                      @else
                      <?php
                        echo $product->product_kind_other;
                       ?>
                      @endif

                    </td>
                    <td>
                      @if($product->product_kind ==0 && $product->product_cake_pors==null)
                      <?php
                        if ($product->product_size==1) {
                          echo $product->product_amount." KG";
                        }elseif ($product->product_size==2) {
                            echo $product->product_amount." ƏDƏD ";
                        }

                       ?>

                      @else
                      <?php
                        echo $product->product_cake_pors." Pors";
                       ?>
                      @endif
                    </td>

                    <td style="width:180px;">
                      <?php

                      $product_user_dateformat_arch=new DateTime($product->user_time);
                      echo   $user_current->user_name." ".$product_user_dateformat_arch->format('d.m.Y H:i');
                       ?>

                    <td style="width:20px;">
                      <a href="{{URL::to('/show_product/'.$product->product_id)}}" class="text-secondary" data-toggle="tooltip" style="margin-left:10px;" data-placement="top" title="Göstər"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>

    </div>
  </div>
    <!-- END DATA TABLE-->
</div>








@endsection
