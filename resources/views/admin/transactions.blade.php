@extends('layouts.admin')

@section('title', 'Пользователи')



@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Общая прибыль</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>{{\App\UserTransaction::getSumInPeriod(0, 1945346334)}}₽</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Прибыль за период</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$sumInPeriod}}₽</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-2 col-sm-6">
            от: <input type="text" id="datepicker-from">

        </div>
        <div class="col-md-2 col-sm-6">
            до: <input type="text" id="datepicker-to">
        </div>
        <div class="col-md-2">
            <button type="button" id="summary-date-filter" class="btn btn-info ">поиск</button>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="mb-3 card">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab-eg-55">

                        <div class="widget-chart p-3">
                            <h5 class="card-title">Список транзакций</h5><br/>
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

                        </div>
                        <div class="widget-chart p-3">
                            {{ $transactions->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/js/dp-ru.js"></script>
    <script src="/js/summary/index.js"></script>
@endsection
