@extends('layouts.admin')

@section('title', 'Пользователи')



@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white flex-wrap">
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

                        <div class="p-3">
                            <h5 class="card-title text-center">Список ключей</h5>
                            <div class="text-right">
                                <div class="dropdown d-inline-block">
                                    <button type="button" aria-haspopup="true" aria-expanded="false"
                                            data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-primary">
                                        Выберите действие
                                    </button>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu"
                                         x-placement="bottom-start"
                                         style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                                        <button type="button" data-action-type="longer-7" tabindex="0"
                                                class="dropdown-item mass-action">Продлить (на 7 дней)
                                        </button>
                                        <button type="button" data-action-type="freeze-7" tabindex="0"
                                                class="dropdown-item mass-action">Заморозить (на 7
                                            дней)
                                        </button>
                                        <button type="button" data-action-type="unfreeze" tabindex="0"
                                                class="dropdown-item mass-action">Разморозить
                                        </button>
                                        <button type="button" data-action-type="deactivate" tabindex="0"
                                                class="dropdown-item mass-action">Деактивировать
                                        </button>
                                        <button type="button" data-action-type="activate" tabindex="0"
                                                class="dropdown-item mass-action">Активировать
                                        </button>
                                        <button type="button" data-action-type="delete" tabindex="0"
                                                class="dropdown-item mass-action">Удалить
                                        </button>
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
                                            <td>
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" id="checkbox-key-{{$key->id}}"
                                                           data-id="{{$key->id}}"
                                                           class="custom-control-input single-checkbox">
                                                    <label class="custom-control-label"
                                                           for="checkbox-key-{{$key->id}}"></label>
                                                </div>
                                            </td>
                                            <th scope="row">{{$key->id}}</th>
                                            <td>{{$key->login}}</td>
                                            <td>{{$key->password}}</td>
                                            <td>
                                                <a href="{{url('/admin/user-card', ['id' => $key->user_id])}}">{{$key->user->full_name}}</a>
                                            </td>
                                            <td>{{date('H:i d/m/Y', $key->end_date)}}</td>
                                            <td>{{$key->key_validity_time}}</td>
                                            <td>
                                                @if($key->status == 0 && $key->is_frozen == 0)
                                                    <div class="badge badge-danger">не активен</div>
                                                @elseif($key->status == 1 && $key->is_frozen == 0)
                                                    <div class="badge badge-success">активен</div>
                                                @elseif($key->is_frozen == 1)
                                                    <div class="badge badge-info">заморожен</div>
                                                @endif
                                            </td>
                                            <td nowrap>
                                                <a class="mr-2 btn btn-info"
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
                                                    class="mr-2 btn btn-success"
                                                    @else
                                                    class="mr-2 btn btn-danger"
                                                    @endif
                                                    @if($key->status == 0)
                                                    href="{{url('/admin/activate-key/' . $key->id)}}"
                                                    @else
                                                    href="{{url('/admin/deactivate-key/' . $key->id)}}"
                                                    @endif
                                                    role="button">
                                                    <span class="fa fa-power-off"></span>
                                                </a>
                                                <a class="mr-2 btn btn-danger"
                                                   href="{{url('/admin/delete-key/' . $key->id)}}"
                                                   role="button">
                                                    <span class="fa fa-trash"></span>
                                                </a>
                                                <a class="mr-2 btn btn-success"
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
                case 'freeze-7':
                    requestUrl = '/admin/freeze-key/';
                    massAction(requestUrl);
                    break;
                case 'unfreeze':
                    requestUrl = '/admin/unfreeze-key/';
                    massAction(requestUrl);
                    break;
                case 'longer-7':
                    requestUrl = '/admin/long-key/';
                    massAction(requestUrl);
                    break;
                case 'deactivate':
                    requestUrl = '/admin/deactivate-key/';
                    massAction(requestUrl);
                    break;
                case 'activate':
                    requestUrl = '/admin/activate-key/';
                    massAction(requestUrl);
                    break;
                case 'delete':
                    requestUrl = '/admin/delete-key/';
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
<script>


</script>
