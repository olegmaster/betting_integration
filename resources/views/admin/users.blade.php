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
                                        <td>{{$user->full_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->sum}}</td>
                                        <td>{{$user->keys_count}}</td>
                                        <td>
                                            @if($user->account_status == 0)
                                                <div class="mb-2 mr-2 badge badge-danger">не активен</div>
                                            @else
                                                <div class="mb-2 mr-2 badge badge-success">активен</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="mb-2 mr-2 btn btn-primary"
                                               href="{{url('/admin/login-as', ['id' => $user->id])}}"><span
                                                    class="fa fa-arrow-right"></span>
                                            </a>
                                            <a class="mb-2 mr-2 btn btn-info" role="button"
                                               href="{{url('/admin/user-card', ['id' => $user->id])}}"><span
                                                    class="pe-7s-look"></span>
                                            </a>
                                            <a class="mb-2 mr-2 btn
                                                @if($user->account_status == 0)
                                                    btn-danger
                                                @else
                                                    btn-success
                                                @endif
                                                "
                                               href="{{url('/admin/change-status', ['id' => $user->id])}}"
                                               role="button"
                                            ><i class="fa fa-power-off"></i>
                                            </a>
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
