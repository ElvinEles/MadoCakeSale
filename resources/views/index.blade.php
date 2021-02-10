<!DOCTYPE html>
<html lang="en">
<?php


 ?>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title> @yield('title')</title>
    <link rel="icon" type="image/gif/png" href="{{asset('images/icon/logo.png')}}">
    <!-- Fontfaces CSS-->
    <link href="{{asset('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::to('css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL::to('css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Vendor CSS-->
    <link href="{{asset('css/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/datepicker.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/jquery.datetimepicker.css')}}" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="{{asset('css/theme.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" media="all">


</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="#">
                            <img src="{{asset('images/icon/logo.png')}}" alt="MadoCafe" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        @include('include/navbarMobile')
                    </ul>
                </div>
            </nav>


        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{URL::to('/allproducts')}}">
                    <img src="{{asset('images/icon/logo.png')}}" alt="Mado Logo" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                    @include('include/navbar')
                    </ul>
                </nav>


            </div>


        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header"  >

                             <?php
                                   $message=DB::table('tbl_message')->where('message_id','=',1)->first();
                              ?>

                                @if($message->message !=null || $message->message="")
                                <div style="font-size:12px;width:700px;height:50px;margin:10px;padding:3px;" class="alert alert-danger">
                                 {{substr($message->message,0,90)}}
                                </div>
                                @endif
                            </form>

                            <?php

                            $countproducts=DB::table('tbl_product')
                                           ->where([
                                             ['product_achieve','=',0],
                                             ['product_recieved','=',0]
                                           ])
                                           ->count();

                             ?>


                            <div class="header-button pull-left">

                                <div class="noti-wrap">
                                  @if(session()->get('user_id')==6)
                                    <div class="noti__item js-item-menu" style="font-size:5px;">
                                        <i class="fa fa-bell fa-xs"></i>
                                        <span class="quantity">{{$countproducts}}</span>
                                    </div>
                                  @endif
                                    <div class="noti__item">
                                      <a href="{{URL::to('/logout_user')}}" data-toggle="tooltip"  data-placement="top" title="Logout"><i class="fa fa-sign-out-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div  class="main-content-inner">


                      <div style="margin-top:75px;"  class="row">

                       @yield('content')

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                 <p>Hazırladı: Elvin Elesgerov <a href="#">@elvineles</a> </p>
                                </div>
                            </div>
                        </div>


            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('js/slick.min.js')}}">
    </script>
    <script src="{{asset('js/wow.min.js')}}"></script>
    <script src="{{asset('js/animsition.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('js/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('js/circle-progress.min.js')}}"></script>
    <script src="{{asset('js/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('js/jquery.datetimepicker.full.js')}}"></script>

    <!-- Main JS-->
    <script src="{{asset('js/main.js')}}"></script>

    <script type="text/javascript">

              $('#datepicker').datetimepicker({
                format:'d.m.Y H:i'
              });

              $('#product_accept_date_value').datetimepicker({
                format:'d.m.Y H:i'
              });

              $('#product_recieve_date_value').datetimepicker({
                format:'d.m.Y H:i'
              });




              $('#staticModalArchieve').on('show.bs.modal',function(e) {
                    var product_id=$(e.relatedTarget).data('id');
                    $('#dataproductidar').val(product_id);
                  });

                  $('#staticModal').on('show.bs.modal',function(e) {
                        var product_id=$(e.relatedTarget).data('id');
                        $('#dataproductid').val(product_id);
                      });

                      $('#printMe').click(function(){
                      window.print();
                      });

       </script>

       <script type="text/javascript">

       $(document).ready(function(){

             $('#product_id_value').focusout(function(){

               var product_id_value=$('#product_id_value').val();
              console.log(product_id_value);

              if ($.trim(product_id_value) !=null && $.trim(product_id_value) != "") {

               $('#product_accept_date_value').attr("disabled","true");
               $('#product_recieve_date_value').attr("disabled","true");
               $('#product_recieve_person_value').attr("disabled","true");
               $('#product_kind_or_other_value').attr("disabled","true");
               $('#product_amount_value').attr("disabled","true");
             }else {

                $('#product_accept_date_value').removeAttr("disabled");
                $('#product_recieve_date_value').removeAttr("disabled");
                $('#product_recieve_person_value').removeAttr("disabled");
                $('#product_kind_or_other_value').removeAttr("disabled");
                $('#product_amount_value').removeAttr("disabled");
             }


             });

       });



       </script>




</body>

</html>
<!-- end document-->
