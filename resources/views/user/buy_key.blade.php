@extends('layouts.cabinet')

@section('title', 'Купить ключ')



@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-photo-gallery">
                    </i>
                </div>
                <div>Купить ключ
                    <div class="page-title-subheading">
                        От 1 ключа - 2 600 рублей неделя<br/>
                        От 10 ключей - 2 300 рублей неделя<br/>
                        От 30 ключей - 2 000 рублей неделя<br/>
                    </div>
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
                            <form class="" method="POST" action="{{url('/cabinet/buy-key-handle')}}">
                                @csrf
                                <div class="position-relative form-group">
                                    <label for="count" class="">Введите количество ключей для покупки</label>
                                    <input name="count" id="count" placeholder="0" type="number"
                                           class="form-control"
                                           value="{{$telegram_id ?? ""}}"><br/>
                                    @if ($errors->first('count'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('count') }}
                                        </div>
                                    @endif
                                </div>

                                <button class="mt-1 btn btn-success">Купить</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
