<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ورود</title>
    <link href=" {{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href=" {{ asset('bootstrap-5.0.2/dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href=" {{ asset('custom/style.css') }}" rel="stylesheet">
    <link href=" {{ asset('bootstrap-fonts/bootstrap-icons.css') }}" rel="stylesheet">
</head>
<body class="app flex-row align-items-center">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group mb-0">


                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <div>

                        </div>
                    </div>
                </div>

                <div class="card p-4">
                    <div class="card-body">
                        <h1 class="text-right">ورود</h1>
                        <p class="text-muted text-right">ورود به حساب کاربری</p>
                        <div class="input-group mb-3">
                                <span class="input-group-addon"><i class="bi bi-person-fill"></i></i>
                                </span>
                            <input type="text" class="form-control admin-user" placeholder="نام کاربری">
                        </div>
                        <div class="input-group mb-4">
                                <span class="input-group-addon"><i class="bi bi-key-fill"></i></i>
                                </span>
                            <input type="password" class="form-control admin-pass" placeholder="رمز عبور">
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary px-4 w-100">ورود</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and necessary plugins -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/tether/dist/js/tether.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>





