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
    <link rel="shortcut icon" href="/landing/assets/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/main.css" rel="stylesheet">
    <link href="/custom.css" rel="stylesheet">
{{--    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css" />--}}
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <div class="app-header header-shadow bg-royal header-text-light">
        <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
                <span>
                    <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-left flex-fill">
                <div class="header-user-info mx-auto d-block d-lg-none">
                    <div class="widget-heading"
                         style="color: rgba(255,255,255,0.8);
                                opacity: .8;
                                font-weight: bold;
                         ">Админ
                    </div>
                </div>
            </div>
            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                       class="p-0 btn">
                                        <img width="42" class="rounded-circle"
                                             src="/uploads/{{\Illuminate\Support\Facades\Auth::user()->avatar ?? ''}}"
                                             alt="">
                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true"
                                         class="dropdown-menu dropdown-menu-right">
                                        <button type="button" tabindex="0" class="dropdown-item">
                                            <a class="dropdown-item" href="{{url('/admin/profile')}}">
                                                {{ __('Профиль') }}
                                            </a>
                                        </button>
                                        <button type="button" tabindex="0" class="dropdown-item">

                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Выйти') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left ml-3 header-user-info d-lg-block">
                                <div class="widget-heading">
                                    Админ
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-main">
        <div class="app-sidebar sidebar-shadow bg-royal sidebar-text-light">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                        <span>
                            <button type="button"
                                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
            </div>
            <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu">
                        <li>
                            <a href="/admin" @if(\Illuminate\Support\Facades\Route::current()->getName() == 'summary')
                                    class="mm-active"
                               @endif >
                                <i class="pe-7s-graph2  metismenu-icon
                                    "></i>
                                Сводка
                            </a>
                        </li>
                        <li>
                            <a href="/admin/users" @if(\Illuminate\Support\Facades\Route::current()->getName() == 'ausers')
                            class="mm-active"
                                @endif>
                                <i class="pe-7s-users  metismenu-icon"></i>
                                Пользователи
                            </a>
                        </li>
                        <li>
                            <a href="/admin/keys" @if(\Illuminate\Support\Facades\Route::current()->getName() == 'akeys')
                            class="mm-active"
                                @endif>
                                <i class="pe-7s-key  metismenu-icon"></i>
                                Ключи
                            </a>
                        </li>
                        <li>
                            <a href="/admin/transaction-history" @if(\Illuminate\Support\Facades\Route::current()->getName() == 'atrans')
                            class="mm-active"
                                @endif>
                                <i class="pe-7s-credit  metismenu-icon"></i>
                                История транзакций
                            </a>
                        </li>
                        <li>
                            <a  href="#">
                                <i class="pe-7s-tools  metismenu-icon"></i>
                                Настройки
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul class="mm-collapse">
                                <li>
                                    <a href="/admin/bot-download">
                                        <i class="metismenu-icon "></i>
                                        Загрузить бота
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/help">
                                        <i class="metismenu-icon">
                                        </i>Страница "помощь"
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/profile">
                                        <i class="metismenu-icon">
                                        </i>Профиль
                                    </a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="app-main__outer">
            <div class="app-main__inner">
                @yield('content')
            </div>

        </div>
{{--        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>--}}
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="/assets/scripts/main.js"></script>
<script type="text/javascript" src="/assets/scripts/custom.js"></script>
@yield('local-script')
</body>
</html>
