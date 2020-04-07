<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Вход в аккаунт - Osminog.bet</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="Вход в аккаунт - Osminog.bet">
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
    <link href="/landing/main.css" rel="stylesheet">
</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow">
    <div class="app-container">
        <div class="h-100">
            <div class="h-100 no-gutters row">
                <div class="d-none d-lg-block col-lg-4">
                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate"
                         tabindex="-1">
                        <div class="slide-img-bg" style="background-image: url('/assets/images/city.jpg');"></div>
                    </div>
                </div>
                <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                    <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                        <div class="app-logo"></div>
                        <h4 class="mb-0">
                            <span class="d-block">Добро пожаловать,</span>
                            <span>Пожалуйста, войдите в свой аккаунт.</span>
                        </h4>
                        <h6 class="mt-3">Нет аккаунта? <a href="{{ route('register') }}" class="text-primary">Регистрация</a>
                        </h6>
                        <div class="divider row"></div>
                        <div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail" class="">Email или телефон</label>
                                            <input name="email" id="exampleEmail" placeholder="Email или телефон..."
                                                   type="text" class="form-control" value="{{ old('email') }}">

                                        </div>
                                        @error('email')
                                        <span class="" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="examplePassword" class="">Пароль</label>
                                            <input name="password" id="examplePassword" placeholder="Пароль..."
                                                   type="password" class="form-control">
                                            @error('password')
                                                <span class="" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative form-check">
                                    <input name="remember" id="exampleCheck" type="checkbox" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="exampleCheck" class="form-check-label">Запомнить меня</label>
                                </div>
                                <div class="divider row"></div>
                                <div class="d-flex align-items-center">
                                    <div class="ml-auto"><a href="{{ route('password.request') }}"
                                                            class="btn-lg btn btn-link">Восстановить пароль</a>
                                        <button class="btn btn-primary btn-lg">Войти</button>
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
<script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>
</html>
