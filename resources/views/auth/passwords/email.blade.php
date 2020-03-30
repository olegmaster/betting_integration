<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Восстановление пароля - Osminog.bet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Восстановление пароля - Osminog.bet">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="/main.css" rel="stylesheet">
</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow">
    <div class="app-container">
        <div class="h-100">
            <div class="h-100 no-gutters row">
                <div class="d-none d-lg-block col-lg-4">
                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                        <div class="slide-img-bg" style="background-image: url('/assets/images/city.jpg');"></div>
                    </div>
                </div>
                <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                    <div class="mx-auto app-login-box col-sm-12 col-md-8 col-lg-6">
                        <div class="app-logo"></div>
                        <h4>
                            <div>Забыли пароль?</div>
                            <span>Используйте форму ниже для восстановления аккаунта.</span></h4>
                        <div>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">

                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ url('/password/email') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail" class="">Email</label>
                                            <input name="email" id="exampleEmail" placeholder="Email..." type="email" class="form-control" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex align-items-center">
                                    <h6 class="mb-0"><a href="{{ url('/login') }}" class="text-primary">Войти в аккаунт</a></h6>
                                    <div class="ml-auto">
                                        <button class="btn btn-primary btn-lg">Восстановить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/assets/scripts/main.js"></script></body>
</html>
