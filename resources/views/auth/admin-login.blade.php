<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('title')</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/main.css" rel="stylesheet">
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

    <div class="app-main">

        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <div class="main-card mb-6 card">
                            <div class="card-body"><h5 class="card-title">Admin login</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" action="{{ url('/admin/login') }}">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail" class="">Email</label>
                                                        <input name="email" id="exampleEmail" placeholder="Email here..."
                                                               type="text" class="form-control" value="{{ old('email') }}">
                                                    </div>
                                                    @error('email')
                                                    <span class="" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="position-relative form-group">
                                                        <label for="examplePassword" class="">Password</label>
                                                        <input name="password" id="examplePassword" placeholder="Password here..."
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
                                                <label for="exampleCheck" class="form-check-label">Keep me logged in</label>
                                            </div>
                                            <div class="divider row"></div>
                                            <div class="d-flex align-items-center">
                                                <div class="ml-auto">
                                                    <button class="btn btn-primary btn-lg">Login</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>

        </div>
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    </div>
</div>
<script type="text/javascript" src="/assets/scripts/main.js"></script>
</body>
</html>
