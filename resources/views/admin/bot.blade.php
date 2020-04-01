<?php

use Illuminate\Support\Facades\Session;

?>

@extends('layouts.admin')

@section('title', 'Скачать бота')


@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-body"><h5 class="card-title">Загрузка бота</h5>
                    <form class="" method="POST" action="/admin/bot-save" enctype="multipart/form-data" >
                        @csrf
                        @if(Session::has('bot-saved'))
                            <p class="alert alert-success">{{ Session::get('bot-saved') }}</p>
                        @endif
                        <div class="position-relative form-group">
                            <input type="file" name="bot" class="form-control-file border">
                            <small>После загрузки нового бота, старый бот будет удален!</small>
                        </div>

                        @if ($errors->first('bot'))
                            <div class="alert alert-danger">
                                {{ $errors->first('bot') }}
                            </div>
                        @endif
                        <button class="mt-1 btn btn-success">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">

        </div>
    </div>

@endsection
