@extends('index')

@section('title')
Kateqoriyalar
@endsection

@section('content')
   <div class="col-lg-12">
     <div class="card">
         <div class="card-header">
             <strong>Kateqoriya Əlavə et</strong>

             @if(session()->get('category_name_notification'))
             <p style="color:#1b5e20">
             <?php
              echo session()->get('category_name_notification');
              session()->forget('category_name_notification')
              ?>
              </p>
             @endif
         </div>
         <div class="card-body card-block">
             <form action="{{URL::to('save_category')}}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                 <div class="row form-group">
                     <div class="col col-md-3">
                         <label for="hf-email" class=" form-control-label">Kateqoriya adı</label>
                     </div>
                       <div class="col-md-6">
                         <input type="text" id="hf-email" autocomplete="off" name="category_name"  class="form-control">
                       </div>
                       <div class="col-md-3 pull-right">
                         <button type="submit" class="btn btn-primary btn-block">
                             <i class="fa fa-dot-circle-o"></i> Təsdiqlə
                         </button>
                       </div>
                 </div>
             </form>
         </div>
     </div>

   </div>


   <div class="col-lg-12">
     <div class="card">
         <div class="card-header">
             <strong>Kateqoriya Sil</strong>

             @if(session()->get('category_name_notification_delete'))
             <p style="color:#1b5e20">
             <?php
              echo session()->get('category_name_notification_delete');
              session()->forget('category_name_notification_delete')
              ?>
              </p>
             @endif
         </div>
         <div class="card-body card-block">
             <form action="{{URL::to('delete_category')}}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                 <div class="row form-group">
                     <div class="col col-md-3">
                         <label for="hf-email" class=" form-control-label">Kateqoriya adı</label>
                     </div>
                       <div class="col-md-6">
                        <select class="form-control" name="category_id">
                          <option value="0">Kateqoriyanı seçin</option>
                           @foreach($categories as $category)
                           <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                          @endforeach
                         </select>
                       </div>
                       <div class="col-md-3 pull-right">
                         <button type="submit" class="btn btn-danger btn-block">
                             <i class="fa fa-dot-circle-o"></i> Sil
                         </button>
                       </div>
                 </div>
             </form>
         </div>
     </div>

   </div>



   <div class="col-lg-12">
     <div class="card">
         <div class="card-header">
             <strong>Kateqoriya Yenilə</strong>

             @if(session()->get('category_name_notification_update'))
             <p style="color:#1b5e20">
             <?php
              echo session()->get('category_name_notification_update');
              session()->forget('category_name_notification_update')
              ?>
              </p>
             @endif
         </div>
         <div class="card-body card-block">
             <form action="{{URL::to('update_category')}}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                 <div class="row form-group">
                     <div class="col col-md-3">
                         <label for="hf-email" class=" form-control-label">Kateqoriya adı</label>
                     </div>
                       <div class="col-md-3">
                        <select class="form-control" name="category_id">
                          <option value="0">Kateqoriyanı seçin</option>
                           @foreach($categories as $category)
                           <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                          @endforeach
                         </select>
                       </div>

                       <div class="col-md-3">
                            <input type="text" id="hf-email" autocomplete="off" name="category_name"  class="form-control">
                       </div>
                       <div class="col-md-3 pull-right">
                         <button type="submit" class="btn btn-warning btn-block">
                             <i class="fa fa-dot-circle-o"></i> Update
                         </button>
                       </div>
                 </div>
             </form>
         </div>
     </div>

   </div>


@endsection
