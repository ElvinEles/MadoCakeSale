@extends('index')

@section('title')
Sifariş et
@endsection

@section('content')
<div  class="col-lg-12">
    <div  class="card">
        <div class="card-header">
            <strong>Sifariş et</strong>
            <p style="color:red;">@if(session()->has('product_error'))
              <?php
                 echo session()->get('product_error');
                 session()->forget('product_error');
               ?>
               @endif</p>
        </div>
        <div class="card-body card-block">
            <form action="{{URL::to('/saveproduct')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
               {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Sifarişi qəbul edən:</label>
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="text" id="text-input" autocomplete="off" required name="product_recieve_person"  class="form-control">
                    </div>

                    <div class="col col-md-3">
                        <label for="text-input" class="form-control-label">Şöbə:</label>
                    </div>
                    <div class="col col-md-3">
                      <select  id="select" name="product_section_name" required class="form-control">
                          <option value="{{session()->get('user_id')}}">{{session()->get('user_name')}}</option>
                          <option value="0">------</option>
                          <?php
                                  $allsections=DB::table('tbl_user')->get();

                           ?>
                           @foreach($allsections as $section)
                          <option value="{{$section->user_id}}">{{$section->user_name}}</option>
                           @endforeach
                      </select>
                    </div>

                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Təslim tarixi:</label>
                    </div>
                    <div class="col-12 col-md-3">
                          <input id="datepicker" autocomplete="off"  required name="product_recieve_date"  data-format="dd/MM/yyyy hh:mm:ss" type='text' class="form-control pull-left" />
                    </div>
                    <div class="col col-md-3">
                        <label for="text-input" class="form-control-label">Qəbul tarixi:</label>
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="text" id="text-input" readonly name="product_accept_date" value="<?php
                        date_default_timezone_set("Asia/Baku");
                        echo date("d.m.Y H:i");?>"  class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Sifarişçinin adı:</label>
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="text" id="text-input" autocomplete="off"  required name="product_custom_name"  class="form-control">
                    </div>
                    <div class="col col-md-3">
                        <label for="text-input"  class="form-control-label">Sifarişçinin telefonu:</label>
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="text" id="text-input"  autocomplete="off"  name="product_custom_number"  class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Sifarişin qiyməti:</label>
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="text" id="text-input" autocomplete="off"  name="product_price"  class="form-control">
                    </div>
                    <div class="col col-md-3">
                        <label for="text-input" class="form-control-label">Avans:</label>
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="text" id="text-input" autocomplete="off"  name="product_advance"  class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class="form-control-label">Sifarişin növü:</label>
                    </div>
                    <div class="col-12 col-md-3">
                      <select  id="select" name="product_kind" class="form-control">
                          <option value="0">Məhsul Növünü seçin</option>

                          <?php
                             $allcategories=DB::table('tbl_category')->get();
                           ?>
                           @foreach($allcategories as $category)
                          <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                          @endforeach

                      </select>
                    </div>
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Digər Məhsul:</label>
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="text" id="text-input" autocomplete="off"  name="product_kind_other"  class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class="form-control-label">Ölçü vahidi:</label>
                    </div>
                    <div class="col-12 col-md-3">
                      <select  id="select" name="product_size" required class="form-control">
                          <option value="0">Ölçü vahidi seçin</option>
                          <option value="1">KG</option>
                          <option value="2">ƏDƏD</option>
                      </select>
                    </div>
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Miqdar:</label>
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="text" id="text-input" autocomplete="off"  required name="product_amount"  class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input"  class="form-control-label">Neçə nəfərlik:</label>
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="text" id="text-input" autocomplete="off"  name="product_cake_pors"  class="form-control">
                    </div>
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Şəkil:</label>
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="file" id="text-input" name="product_photo"  class="form-control">
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="textarea-input" autocomplete="off"  class=" form-control-label">Əlavə qeyd:</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <textarea name="product_description" id="textarea-input" rows="6" style="resize:none;" class="form-control"></textarea>
                    </div>
                </div>

        </div>
        <div class="card-footer">
        <div class="row form-group">
            <div class="col col-md-6">
              <button type="submit" id="saveproductbutton" class="btn btn-primary btn-block">
                  <i class="fa fa-dot-circle-o"></i> Təsdiqlə
              </button>
            </div>
            <div class="col-12 col-md-6">
              <button type="reset" class="btn btn-danger btn-block">
                  <i class="fa fa-ban"></i> Təmizlə
              </button>
            </div>
        </div>
          </div>

        </form>
    </div>

</div>
@endsection
