@extends('index')

@section('title')
Xəbərdarlıq
@endsection

@section('content')
   <div class="col-lg-12">
     <div class="card">
         <div class="card-header">
             <strong>Mətn</strong>

             @if(session()->get('category_name_notification'))
             <p style="color:#1b5e20">
             <?php
              echo session()->get('message_name_notification');
              session()->forget('message_name_notification')
              ?>
              </p>
             @endif
         </div>

         <?php
               $message=DB::table('tbl_message')->where('message_id','=',1)->first();
          ?>

         <div class="card-body card-block">
             <form action="{{URL::to('update_message')}}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                 <div class="row form-group">
                     <div class="col col-md-3">
                         <label for="hf-email" class=" form-control-label">Mətin 90 hərfdən az olmalıdır</label>
                     </div>

                       <div class="col-md-6">

                         <textarea id="hf-email" rows="4" style="resize:none;" autocomplete="off" name="message"  class="form-control">{{$message->message}}
                         </textarea>
                       </div>
                       <div class="col-md-3 pull-right">
                         <button type="submit" class="btn btn-primary btn-block">
                             <i class="fa fa-dot-circle-o"></i> Yenilə
                         </button>
                       </div>
                 </div>
             </form>
         </div>
     </div>

   </div>


@endsection
