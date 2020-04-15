@extends('layouts.cabinet')

@section('title', 'Пользователи')



@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white flex-wrap">
                    <div class="widget-content-left">
                        <div class="widget-heading">Всего ключей</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$totalKeys}}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-grow-early">
                <div class="widget-content-wrapper text-white flex-wrap">
                    <div class="widget-content-left">
                        <div class="widget-heading">Активных ключей</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$activeKeys}}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white flex-wrap">
                    <div class="widget-content-left">
                        <div class="widget-heading">Замороженных ключей</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$frozenKeys}}</span></div>
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
                            <div class="table-responsive">
                            <table class="mb-0 table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Логин</th>
                                    <th>Пароль</th>
                                    <th>Примечание</th>
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
                                        <td>{{$key->description}}</td>
                                        <td>{{$key->user->full_name}}</td>
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
                                            <a class="mb-2 mr-2 btn btn-primary key-edit"
                                               href="" data-id="{{$key->id}}"
                                               role="button">
                                                <span class="fa fa-edit" data-id="{{$key->id}}"></span>
                                            </a>
                                            @if($key->freeze_times < \App\UserKey::maxFreezeUserCount && $key->is_frozen === 0 )
                                            <a class="mb-2 mr-2 btn btn-info"
                                               @if($key->is_frozen == 1)
                                               href="{{url('/unfreeze-key/' . $key->id)}}"
                                               @else
                                               href="{{url('/freeze-key/' . $key->id)}}"
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
                                            @endif
                                            @if($key->is_frozen === 1 )
                                                <a class="mb-2 mr-2 btn btn-info"
                                                   @if($key->is_frozen == 1)
                                                   href="{{url('/unfreeze-key/' . $key->id)}}"
                                                   @else
                                                   href="{{url('/freeze-key/' . $key->id)}}"
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
                                            @endif
                                            <a class="mb-2 mr-2 btn btn-success"
                                               href="{{url('/long-key/' . $key->id)}}"
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
        $(document).ready(function () {
            $(".key-edit").click(function (e) {
                e.preventDefault();
                $('#key-id').val(e.target.dataset.id);
                $('#exampleModal').modal();
            });
        });
    </script>
@endsection

@section('modal')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Описание ключа</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/user/edit-key-descr">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="description" required></textarea>
                        </div>

                        <input type="hidden" name="key_id" id="key-id">
                        <input class="btn btn-primary" type="submit" value="Обновить"/>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
