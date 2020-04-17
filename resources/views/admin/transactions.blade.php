@extends('layouts.admin')

@section('title', 'Пользователи')



@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white flex-wrap">
                    <div class="widget-content-left">
                        <div class="widget-heading">Общая прибыль</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>{{number_format(\App\UserTransaction::getSumInPeriod(0, 1945346334), 0, " ", " ")}} ₽</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white flex-wrap">
                    <div class="widget-content-left">
                        <div class="widget-heading">Прибыль за период</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <span>{{number_format($sumInPeriod, 0, " ", " ")}} ₽</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-sm-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-calendar-alt"></i>
                    </div>
                </div>
                <input type="text" class="form-control" name="daterange-centered"/>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger reset-button">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="mb-3 card">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab-eg-55">

                        <div class="p-3">
                            <h5 class="card-title text-center">Список транзакций</h5>
                            <div class="table-responsive">
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
                                            <td>
                                                <a href="{{url('/admin/user-card', ['id' => $transaction->user_id])}}">{{$transaction->user->full_name}}</a>
                                            </td>
                                            <td>{{$transaction->user->email}}</td>
                                            <td>{{$transaction->keys_count}}</td>
                                            <td>{{number_format($transaction->sum, 0," ", " ")}}</td>
                                            <td>{{date('H:i d/m/Y', strtotime($transaction->created_at))}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="widget-chart p-3">
                            {{ $transactions->links() }}
                        </div>
                        <input type="hidden" id="dateFromOld" value="{{$dateFrom}}">
                        <input type="hidden" id="dateToOld" value="{{$dateTo}}">
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('local-script')
    <script src="/js/jquery.cookie.js"></script>
    <script src="/js/summary/index.js"></script>
    <script>
        $('.dfd').daterangepicker();
    </script>
@endsection

