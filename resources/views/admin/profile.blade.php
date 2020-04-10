<?php

use Illuminate\Support\Facades\Session;

?>

@extends('layouts.admin')

@section('title', 'Профиль')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-user-circle ">
                    </i>
                </div>
                <div>Admin
                    <div class="page-title-subheading">Информация о пользователе
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-body"><h5 class="card-title">Персональная информация</h5>
                    <form class="" method="POST" action="/profile-store-data">
                        @csrf
                        @if(Session::has('saved'))
                            <p class="alert alert-success">{{ Session::get('saved') }}</p>
                        @endif
                        <div class="position-relative form-group">
                            <label for="name" class="">Имя</label>
                            <input name="name" id="name" placeholder="Имя" type="text" class="form-control"
                                   value="{{$userData['name']}}">
                        </div>
                        @if ($errors->first('name'))
                            <div class="alert alert-danger">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <div class="position-relative form-group">
                            <label for="surname" class="">Фамилия</label>
                            <input name="surname" id="surname" placeholder="Фамилия" type="text" class="form-control"
                                   value="{{$userData['surname']}}">
                        </div>
                        @if ($errors->first('surname'))
                            <div class="alert alert-danger">
                                {{ $errors->first('surname') }}
                            </div>
                        @endif
                        <div class="position-relative form-group">
                            <label for="email" class="">Email (login)</label>
                            <input name="email" id="email" placeholder="Email (login)" type="text" class="form-control"
                                   value="{{$userData['email']}}">
                        </div>
                        @if ($errors->first('email'))
                            <div class="alert alert-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <button class="mt-1 btn btn-success">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-body">
                    <form class="" method="POST" action="/update-admin-avatar" enctype="multipart/form-data">
                        @csrf
                        @if(Session::has('admin_image_saved'))
                            <p class="alert alert-success">{{ Session::get('admin_image_saved') }}</p>
                        @endif
                        <div class="position-relative form-group">
                            <label for="name" class="">Сменить изображение</label>
                            <input type="file" name="admin-avatar" class="form-control-file border">
                        </div>
                        @if ($errors->first('admin-avatar'))
                            <div class="alert alert-danger">
                                {{ $errors->first('admin-avatar') }}
                            </div>
                        @endif

                        <button class="mt-1 btn btn-success">Сохранить</button>
                    </form>
                </div>
            </div>
            <div class="mb-3 card">
                <div class="card-body"><h5 class="card-title">Сменить пароль</h5>
                    <form class="" method="POST" action="/update-admin-password">
                        @csrf
                        @if(Session::has('password_saved'))
                            <p class="alert alert-success">{{ Session::get('password_saved') }}</p>
                        @endif
                        <div class="input-group mb-3 wrapperPassword">
                            <input name="password" id="login" placeholder="Новый пароль" type="password"
                                   class="form-control">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-light toggleViewPassword">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        @if ($errors->first('password'))
                            <div class="alert alert-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <div class="input-group mb-3 wrapperPassword">
                            <input name="repeat-password" id="login" placeholder="Повторите пароль" type="password"
                                   class="form-control">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-light toggleViewPassword">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        @if ($errors->first('repeat-password'))
                            <div class="alert alert-danger">
                                {{ $errors->first('repeat-password') }}
                            </div>
                        @endif

                        <button class="mt-1 btn btn-success">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
