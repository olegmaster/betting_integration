@extends('layouts.admin')

@section('title', 'Пользователи')



@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Ключей</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$totalKeys}}</span></div>
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
                            <h5 class="card-title">Список ключей</h5><br/>
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

                        </div>
                        <div class="widget-chart p-3">
                            {{ $keys->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
