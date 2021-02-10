<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

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
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">

                                <img style="width:140px;height:80px;" src="{{asset('images/icon/logo.png')}}" alt="MadoCafe">
                <p style="color:red;">
              
                  @if(session()->has('user_error'))
                  <?php
                  echo session()->get('user_error');
                  session()->forget('user_error');
                   ?>
                  @endif
                </p>
                        </div>
                        <div class="login-form">
                            <form action="{{URL::to('/logincheck')}}" method="post">
                               {{ csrf_field() }}
                                <div class="form-group">
                                  <label>User:</label>
                                  <select class="form-control" name="user_id">
                                    <option value="0">Useri seçin...</option>
                                    @foreach($allusers as $user)
                                    <option value="{{$user->user_id}}">{{$user->user_name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label>Parol</label>
                                    <input class="au-input au-input--full" required autocomplete="off" type="password" name="user_password" placeholder="Parol">
                                </div>

                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Daxil ol</button>
                            </form>
                            <div class="register-link">
                                <p>
                                  Hazırladı: Elvin Elesgerov

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

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


</body>

</html>
<!-- end document-->
