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
                <div>{{$user->full_name}}
                    <div class="page-title-subheading">Информация о пользователе
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Транзакций пользователя</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>{{\App\UserTransaction::getSumInPeriod(0, 1945346334, $user['id'])}}₽</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Всего ключей</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$user->keys()->count()}}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="mb-3 card">

                <div class="card-body">
                    <div class="btn-actions-pane-right">
                        <div class="nav">
                            <a data-toggle="tab" href="#tab-eg6-0" class="border-0 btn-transition btn btn-outline-primary active show">Профиль</a>
                            <a data-toggle="tab" href="#tab-eg6-1" class="mr-1 ml-1 border-0 btn-transition btn btn-outline-primary show">Ключи</a>
                            <a data-toggle="tab" href="#tab-eg6-2" class="border-0 btn-transition btn btn-outline-primary show">Транзакции</a>
                        </div>
                    </div><br/>
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-eg6-0" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="main-card mb-3 card">
                                            <div class="card-body"><h5 class="card-title">Персональная информация</h5>
                                                <form class="" method="POST" action="{{url('/admin/update-user-profile', ['id' => $user['id']])}}">
                                                    @csrf
                                                    @if(Session::has('user_profile_updated'))
                                                        <p class="alert alert-success">{{ Session::get('user_profile_updated') }}</p>
                                                    @endif
                                                    <div class="position-relative form-group">
                                                        <label for="name" class="">Имя</label>
                                                        <input name="name" id="name" placeholder="Имя" type="text" class="form-control"
                                                               value="{{$user['name']}}">
                                                    </div>
                                                    @if ($errors->first('name'))
                                                        <div class="alert alert-danger">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                    <div class="position-relative form-group">
                                                        <label for="surname" class="">Фамилия</label>
                                                        <input name="surname" id="surname" placeholder="Фамилия" type="text" class="form-control"
                                                               value="{{$user['surname']}}">
                                                    </div>
                                                    @if ($errors->first('surname'))
                                                        <div class="alert alert-danger">
                                                            {{ $errors->first('surname') }}
                                                        </div>
                                                    @endif
                                                    <div class="position-relative form-group">
                                                        <label for="email" class="">Email (login)</label>
                                                        <input name="email" id="email" placeholder="Email (login)" type="text" class="form-control"
                                                               value="{{$user['email']}}">
                                                    </div>
                                                    @if ($errors->first('email'))
                                                        <div class="alert alert-danger">
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    @endif
                                                    <button class="mt-1 btn btn-success">Сохранить</button>
                                                </form></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="main-card mb-3 card">
                                            <div class="card-body"><h5 class="card-title">Сменить Пароль</h5>
                                                <form class="" method="POST" action="{{url('/admin/update-user-password', ['id' => $user['id']])}}">
                                                    @csrf
                                                    @if(Session::has('user_password_updated'))
                                                        <p class="alert alert-success">{{ Session::get('user_password_updated') }}</p>
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
                            </div>
                        </div>
                        <div class="tab-pane show" id="tab-eg6-1" role="tabpanel">
                            <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Логин</th>
                                    <th>Пароль</th>
                                    <th>Пользователь</th>
                                    <th>Дата окончания</th>
                                    <th>Статус актуален еще</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($keys as $key)
                                    <tr>
                                        <th scope="row">{{$key->id}}</th>
                                        <td>{{$key->login}}</td>
                                        <td>{{$key->password}}</td>
                                        <td>{{$key->user->full_name}}</td>
                                        <td>{{date('H:i d/m/Y', $key->end_date)}}</td>
                                        <td>{{$key->key_validity_time}}</td>
                                        <td>
                                            @if($key->status == 0)
                                                <div class="mb-2 mr-2 badge badge-danger">не активен</div>
                                            @else
                                                <div class="mb-2 mr-2 badge badge-success">активен</div>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="mb-2 mr-2 btn btn-primary"><span class="fa fa-arrow-right"></span>
                                            </button>
                                            <button class="mb-2 mr-2 btn btn-info"><span class="pe-7s-look"></span>
                                            </button>
                                            <button class="mb-2 mr-2 btn btn-success"><i class="fa fa-power-off"></i>
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="widget-chart p-3">
                                {{ $keys->links() }}
                            </div>
                        </div>
                        <div class="tab-pane show" id="tab-eg6-2" role="tabpanel">
                            <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ФИО</th>
                                    <th>Email</th>
                                    <th>Ключей</th>
                                    <th>Сумма, ₽</th>
                                    <th>Дата создания</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <th scope="row">{{$transaction->id}}</th>
                                        <td>{{$transaction->user->full_name}}</td>
                                        <td>{{$transaction->user->email}}</td>
                                        <td>{{$transaction->keys_count}}</td>
                                        <td>{{$transaction->sum}}</td>
                                        <td>{{date('H:i d/m/Y', strtotime($transaction->created_at))}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="widget-chart p-3">
                                {{ $transactions->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection