<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href=" {{ asset('bootstrap-5.0.2/dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href=" {{ asset('bootstrap-fonts/bootstrap-icons.css') }}" rel="stylesheet">
    <link href=" {{ asset('custom/style.css') }}" rel="stylesheet">
    <link href=" {{ asset('WebFonts/css/fontiran.css') }}" rel="stylesheet">
    <title>ورود به پنل مدیریت</title>
</head>
<body>

<div class="admin-login">
    <form action="{{ route('admin.DoLogin') }}" method="post">
        @csrf
        <h4>ورود به پنل مدیریت</h4>

        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
    {{--    @if($errors->has('username'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('username') }}
            </div>
        @endif

        @if($errors->has('password'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('password') }}
            </div>
        @endif--}}
        <div class="input-group mb-3 admin-username">
            <span class="input-group-text" id=""><i class="bi bi-person-fill"></i></span>
            <input name="username" type="email" class="form-control" placeholder="" aria-label="" >
        </div>

        <div class="input-group mb-3 admin-password">
            <span class="input-group-text" id=""><i class="bi bi-shield-lock"></i></span>
            <input name="password" type="password" class="form-control" placeholder="" aria-label="" >
        </div>

{{--        <div class="mb-3 form-check">
            <input name="remember" type="checkbox" class="form-check-input">
            <label class="form-check-label" for="">مرا به خاطر بسپار</label>
        </div>--}}
        <button type="submit" class="btn btn-them">ورود</button>
    </form>

</div>

</body>
</html>
