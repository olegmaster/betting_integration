@extends('layouts.admin')

@section('title', 'Пользователи')



@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Пользователей</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers "><span>{{$totalUsers}}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Products Sold</div>
                        <div class="widget-subheading">Revenue streams</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>$14M</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="mb-3 card">

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab-eg-55">

                        <div class="widget-chart p-3">
                            <h5 class="card-title">Список пользователей</h5><br/>
                            <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ФИО</th>
                                    <th>Email</th>
                                    <th>Потрачено денег, ₽</th>
                                    <th>Ключей</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->sum}}</td>
                                    <td>@mdo</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
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

                        </div>
                        <div class="widget-chart p-3">
                            {{ $users->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection