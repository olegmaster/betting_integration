@extends('layouts.cabinet')

@section('title', 'Настройки')


@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-tools">
                    </i>
                </div>
                <div>Настройки
                    <div class="page-title-subheading">Чтобы узнать ID для подключения Osminog.bet помощника, Вам
                        необходимо нажать "Начать" в Telegram бот @OsminogAssistant
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-10 col-xl-9">
            <div class="mb-3 card">

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab-eg-55">
                        <div class="widget-chart p-3">
                            <form class="" method="POST" action="{{url('/cabinet/setup-update')}}">
                                @csrf
                                @if(Session::has('telegram_id_saved'))
                                    <p class="alert alert-success">{{ Session::get('telegram_id_saved') }}</p>
                                @endif
                                <div class="position-relative form-group">
                                    <label for="telegram-id" class="">ID вашего телеграмм аккаунта</label>
                                    <input name="telegram-id" id="telegram-id" placeholder="ID" type="number"
                                           class="form-control"
                                           value="{{$telegram_id ?? ""}}"><br/>
                                    @if ($errors->first('telegram-id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('telegram-id') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-check mb-3">
                                    <div class="row">
                                    	<div class="col-12">
                                    		<p><b>УВЕДОМИТЬ МЕНЯ ОБ ОКОНЧАНИИ ПОДПИСКИ НА КЛЮЧАХ</b></p>
                                    	</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-sm-4 col-md-2 text-left">
                                        	<input name="h24" type="checkbox" class="form-check-input"
                                               id="exampleCheck1"
                                               @if($h24)
                                               checked
                                               @endif
                                            >
                                        	<label class="form-check-label" for="exampleCheck1">за 24 часа</label>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-2 text-left">
                                    		<input name="h12" type="checkbox" class="form-check-input"
                                               id="exampleCheck2"
                                               @if($h12)
                                               checked
                                               @endif
                                        	>
                                        	<label class="form-check-label" for="exampleCheck2">за 12 часов</label>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-2 text-left">
                                    		<input name="h6" type="checkbox" class="form-check-input"
                                               id="exampleCheck3"
                                               @if($h6)
                                               checked
                                               @endif
                                            >
                                        	<label class="form-check-label" for="exampleCheck3">за 6 часов</label>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-2 text-left">
                                    		<input name="h3" type="checkbox" class="form-check-input"
                                               id="exampleCheck4"
                                               @if($h3)
                                               checked
                                               @endif
                                            >
                                        	<label class="form-check-label" for="exampleCheck4">за 3 часа</label>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-2 text-left">
                                    		<input name="h1" type="checkbox" class="form-check-input"
                                               id="exampleCheck5"
                                               @if($h1)
                                               checked
                                               @endif
                                            >
                                        	<label class="form-check-label" for="exampleCheck5">за 1 час</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check">
                                </div>
                                <button class="mt-1 btn btn-success">Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
