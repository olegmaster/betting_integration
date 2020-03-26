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
                    <div class="page-title-subheading">Чтобы узнать ID для подключения Osminog.bet помощника, Вам необходимо нажать "Начать" в Telegram бот @OsminogAssistant</div>
                </div>
            </div>
            <div class="page-title-actions">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-9">
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
                                    <input name="telegram-id" id="telegram-id" placeholder="ID" type="number" class="form-control"
                                           value="{{$settings['telegram-id'] ?? ""}}">
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
