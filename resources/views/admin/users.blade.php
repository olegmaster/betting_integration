@extends('layouts.admin')

@section('title', 'Пользователи')



@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white flex-wrap">
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

                        <div class="p-3">
                            <h5 class="card-title text-center">Список пользователей</h5>
                            <div class="text-right">
                                <div class="dropdown d-inline-block">
                                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-primary">
                                        Выберите действие
                                    </button>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                                        <button type="button" data-action-type="activate" tabindex="0" class="dropdown-item mass-action">Активировать</button>
                                        <button type="button" data-action-type="deactivate" tabindex="0" class="dropdown-item mass-action">Деактивировать</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="mb-0 table table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" id="exampleCustomCheckbox"
                                                           class="custom-control-input main-checkbox">
                                                    <label class="custom-control-label" for="exampleCustomCheckbox"></label>
                                                </div>
                                            </th>
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
                                            <td>
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" id="checkbox-user-{{$user->id}}"
                                                           data-id="{{$user->id}}"
                                                           class="custom-control-input single-checkbox">
                                                    <label class="custom-control-label"
                                                           for="checkbox-user-{{$user->id}}"></label>
                                                </div>
                                            </td>
                                            <th scope="row">{{$user->id}}</th>
                                            <td>
                                                <a href="{{url('/admin/user-card', ['id' => $user->id])}}">{{$user->full_name}}</a>
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{number_format($user->sum, 0," ", " ")}}</td>
                                            <td>{{$user->keys_count}}</td>
                                            <td>
                                                @if($user->account_status == 0)
                                                    <div class="badge badge-danger">не активен</div>
                                                @else
                                                    <div class="badge badge-success">активен</div>
                                                @endif
                                            </td>
                                            <td nowrap>
                                                <a class="mr-2 btn btn-primary"
                                                   @if($user->account_status == 1)
                                                        href="{{url('/admin/login-as', ['id' => $user->id])}}"
                                                   @else
                                                        href="#"
                                                   @endif
                                                >
                                                	<i class="fa fa-arrow-right"></i>
                                                </a>
                                                <a class="mr-2 btn btn-info" role="button"
                                                   href="{{url('/admin/user-card', ['id' => $user->id])}}"
                                                >
                                                	<i class="fa fa-eye"></i>
                                                </a>
                                                @if($user->account_status == 0)
                                                    <a class="mr-2 btn btn-danger
                                                        "
                                                       href="{{url('/admin/change-status-activate', ['id' => $user->id])}}"
                                                       role="button"
                                                    >
                                                        <i class="fa fa-power-off"></i>
                                                    </a>
                                                @else
                                                    <a class="mr-2 btn btn-success
                                                        "
                                                       href="{{url('/admin/change-status-deactivate', ['id' => $user->id])}}"
                                                       role="button"
                                                    >
                                                        <i class="fa fa-power-off"></i>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
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
@section('local-script')
    <script>
        $('.main-checkbox').click(function () {
                if ($(this).prop("checked") == true) {
                    $('.single-checkbox').each(function () {
                        if ($(this).prop("checked") == false) {
                            $(this).click();
                        }
                    });
                } else {
                    $('.single-checkbox').each(function () {
                        if ($(this).prop("checked") == true) {
                            $(this).click();
                        }
                    });
                }
            }
        );

        $('.mass-action').click(function () {
            let actionType = $(this).data('actionType');
            console.log(actionType);

            let requestUrl = '';
            switch (actionType) {
                case 'deactivate':
                    requestUrl = '/admin/change-status-deactivate/';
                    massAction(requestUrl);
                    break;
                case 'activate':
                    requestUrl = '/admin/change-status-activate/';
                    massAction(requestUrl);
                    break;
                default:
                    console.log('Sorry, we are out of .');
            }
        });

        function massAction(url) {
            $('.single-checkbox').each(function () {
                if ($(this).prop("checked") == true) {
                    let self = $(this);
                    jQuery.ajax({
                        url: url + $(this).data('id'),
                        success: function (result) {
                            console.log(self.data('id'));
                        },
                        async: false
                    });
                }
            });
            location.reload();
        }
    </script>
@endsection
