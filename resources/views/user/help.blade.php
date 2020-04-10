@extends('layouts.cabinet')

@section('title', 'Помощь')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-user-circle ">
                    </i>
                </div>
                <div>{{\Illuminate\Support\Facades\Auth::user()->full_name}}
                    <div class="page-title-subheading">Информация о пользователе
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

            </div>
        </div>
    </div>
    @if($helpText)
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3 card">

                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab-eg-55">

                            <div class="widget-chart p-3">
                                <?php echo $helpText; ?>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endsection
