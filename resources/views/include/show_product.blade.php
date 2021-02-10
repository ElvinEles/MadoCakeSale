@extends('index')

@section('title')
Sifarişi Göstər
@endsection

@section('content')
<div class="col-md-12">
    <!-- DATA TABLE-->
    <div class="single-table">
    <div class="table-responsive">
        <table class="table table-hover progress-table">
            <thead>
                <tr style="font-size:15px;" class="text-center">
                    <th>Məhsul Xüsusiyyətləri</th>
                    <th>
                    <a href="{{URL::to('/allproducts')}}" class="pull-right" class="text-secondary" data-toggle="tooltip" style="margin-left:10px;" data-placement="top" title="Sifarişlər"><i class="fa fa-list"></i></a>
                    <a href="{{URL::to('/allproducts')}}" id="printMe" class="pull-right" class="text-secondary" data-toggle="tooltip" style="margin-left:10px;" data-placement="top" title="Çap et"><i class="fa fa-print"></i></a>
                     </th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td style="width:300px;">Məhsul ID</td>
                    <td>{{$product->product_id}}</td>
                </tr>
                <tr>
                  <td>Sifarişi alan və Şöbə</td>
                  <td>{{$product->product_recieve_person." ".$product->product_section_name}}</td>
                </tr>
                <tr>
                  <td>Sifarişin qəbul tarixi</td>
                  <td>
                    <?php
                    $product_accepted_dateformat_show=new DateTime($product->product_accept_date);
                    echo   $product_accepted_dateformat_show->format('d.m.Y H:i');
                     ?>
                  </td>
                </tr>
                <tr>
                  <td>Sifarişin təslim tarixi</td>
                  <td>
                    <?php
                    $product_recieve_dateformat_show=new DateTime($product->product_recieve_date);
                    echo   $product_recieve_dateformat_show->format('d.m.Y H:i');
                     ?>
                  </td>
                </tr>
                <tr>
                  <td>Sifarişçinin adı və tel</td>
                  <td>{{$product->product_custom_name." ".$product->product_custom_number}}</td>
                </tr>
                <tr>
                  <td>Sifarişin qiyməti</td>
                  <td>
                    <?php
                     if ($product->product_price !=null) {
                     echo $product->product_price." AZN";
                   }else {
                     echo 0;
                   }
                     ?>
                  </td>
                </tr>
                <tr>
                  <td>Avans</td>
                  <td>
                     <?php
                      if ($product->product_advance !=null) {
                      echo $product->product_advance." AZN";
                    }else {
                      echo 0;
                    }
                      ?>
                  </td>
                </tr>
                <tr>
                  <td>Sifarişin növü</td>
                  <td>
                  <?php

                   $product_kind_value=DB::table('tbl_category')->where('category_id','=',$product->product_kind)->first();
                   if ($product_kind_value !=null) {
                    echo $product_kind_value->category_name;
                  }else {
                    echo $product->product_kind_other;
                  }

                   ?>

                  </td>
                </tr>
                <tr>
                  <td>Miqdarı</td>
                  <td>
                    <?php
                    if ($product->product_size==1) {
                    echo $product->product_amount." KG";
                    }else if ($product->product_size==2){
                      echo $product->product_amount." ƏDƏD";
                    }else {

                    }
                     ?>

                  </td>
                </tr>
                <tr>
                  <td>Şəkil</td>
                  <td>
                    <?php if ($product->product_photo == "No Photo"): ?>
                    <?php echo "Şəkil yoxdur"; ?>
                    <?php else: ?>
                        <img style="width:80px;height:80px;" src="{{URL::to($product->product_photo)}}" alt="No Photo">
                    <?php endif; ?>

                  </td>
                </tr>
                <tr>
                  <td>Əlavə qeyd</td>
                  <td>{{$product->product_description}}</td>
                </tr>
                </tr>

            </tbody>
        </table>
    </div>
  </div>
    <!-- END DATA TABLE-->
</div>



@endsection
