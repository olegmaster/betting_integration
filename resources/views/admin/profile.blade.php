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
                        <div class="position-relative form-group">
                            <label for="name" class="">Имя</label>
                            <input name="name" id="name" placeholder="Имя" type="text" class="form-control" value="{{$userData['name']}}">
                        </div>
                        <div class="position-relative form-group">
                            <label for="surname" class="">Фамилия</label>
                            <input name="surname" id="surname" placeholder="Фамилия" type="text" class="form-control" value="{{$userData['surname']}}">
                        </div>
                        <div class="position-relative form-group">
                            <label for="email" class="">Email (login)</label>
                            <input name="email" id="email" placeholder="Email (login)" type="text" class="form-control" value="{{$userData['email']}}">
                        </div>
                        <button class="mt-1 btn btn-success">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-body">
                    <form class="">
                        <div class="position-relative form-group">
                            <label for="name" class="">Сменить изображение</label>
                            <input type="file" class="form-control-file border">
                        </div>

                        <button class="mt-1 btn btn-success">Сохранить</button>
                    </form>
                </div>
            </div>
            <div class="mb-3 card">
                <div class="card-body"><h5 class="card-title">Сменить пароль</h5>
                    <form class="">

                        <div class="input-group mb-3">
                            <input name="text" id="login" placeholder="Новый пароль" type="password" class="form-control">
                            <div class="input-group-append">
                                <span class="fa fa-eye input-group-text"></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input name="text" id="login" placeholder="Повторите пароль" type="password" class="form-control">
                            <div class="input-group-append">
                                <span class="fa fa-eye input-group-text"></span>
                            </div>
                        </div>

                        <button class="mt-1 btn btn-success">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
