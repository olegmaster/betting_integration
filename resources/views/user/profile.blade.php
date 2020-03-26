@extends('layouts.cabinet')

@section('title', 'Профайл')



@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-user-circle ">
                    </i>
                </div>
                <div>{{\Illuminate\Support\Facades\Auth::user()->full_name}}
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
                    <form class="" method="POST" action="{{url('/cabinet/profile-update')}}">
                        @csrf
                        @if(Session::has('user_profile_saved'))
                            <p class="alert alert-success">{{ Session::get('user_profile_saved') }}</p>
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
                    <form class="" method="POST" action="{{url('/cabinet/update-user-avatar')}}" enctype="multipart/form-data">
                        @csrf
                        @if(Session::has('user_image_saved'))
                            <p class="alert alert-success">{{ Session::get('user_image_saved') }}</p>
                        @endif
                        <div class="position-relative form-group">
                            <label for="name" class="">Сменить изображение</label>
                            <input type="file" name="user-avatar" class="form-control-file border">
                        </div>
                        @if ($errors->first('user-avatar'))
                            <div class="alert alert-danger">
                                {{ $errors->first('user-avatar') }}
                            </div>
                        @endif

                        <button class="mt-1 btn btn-success">Сохранить</button>
                    </form>
                </div>
            </div>
            <div class="mb-3 card">
                <div class="card-body"><h5 class="card-title">Сменить пароль</h5>
                    <form class="" method="POST" action="{{url('/cabinet/update-user-password')}}">
                        @csrf
                        @if(Session::has('password_saved'))
                            <p class="alert alert-success">{{ Session::get('password_saved') }}</p>
                        @endif
                        <div class="input-group mb-3">
                            <input name="password" id="login" placeholder="Новый пароль" type="password"
                                   class="form-control">
                            <div class="input-group-append">
                                <span class="fa fa-eye input-group-text"></span>
                            </div>
                        </div>
                        @if ($errors->first('password'))
                            <div class="alert alert-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <div class="input-group mb-3">
                            <input name="repeat-password" id="login" placeholder="Повторите пароль" type="password"
                                   class="form-control">
                            <div class="input-group-append">
                                <span class="fa fa-eye input-group-text"></span>
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
