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
                                            @if($key->status == 0 && $key->is_frozen == 0)
                                                <div class="mb-2 mr-2 badge badge-danger">не активен</div>
                                            @elseif($key->status == 1 && $key->is_frozen == 0)
                                                <div class="mb-2 mr-2 badge badge-success">активен</div>
                                            @elseif($key->is_frozen == 1)
                                                <div class="mb-2 mr-2 badge badge-info">заморожен</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="mb-2 mr-2 btn btn-info"
                                               @if($key->is_frozen == 1)
                                               href="{{url('/admin/unfreeze-key/' . $key->id)}}"
                                               @else
                                               href="{{url('/admin/freeze-key/' . $key->id)}}"
                                               @endif
                                               role="button">
                                                <span
                                                    @if($key->is_frozen == 1)
                                                    class="fa fa-pause"
                                                    @else
                                                    class="fa fa-play"
                                                    @endif
                                                ></span>
                                            </a>
                                            <a
                                                @if($key->status == 1)
                                                class="mb-2 mr-2 btn btn-success"
                                                @else
                                                class="mb-2 mr-2 btn btn-danger"
                                                @endif
                                               @if($key->status == 0)
                                               href="{{url('/admin/activate-key/' . $key->id)}}"
                                               @else
                                               href="{{url('/admin/deactivate-key/' . $key->id)}}"
                                               @endif
                                               role="button">
                                                <span class="fa fa-power-off"></span>
                                            </a>
                                            <a class="mb-2 mr-2 btn btn-danger"
                                               href="{{url('/admin/delete-key/' . $key->id)}}"
                                               role="button">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                            <a class="mb-2 mr-2 btn btn-success"
                                               href="{{url('/admin/long-key/' . $key->id)}}"
                                               role="button">
                                                <span class="fa fa-calendar-plus"></span>
                                            </a>
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
