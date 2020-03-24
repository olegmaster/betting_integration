@extends('layouts.admin')

@section('title', 'Сводка')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="mb-3 card">
                <div class="card-body"><h5 class="card-title">редактирование страницы "помощ"</h5>
                    <form class="" method="POST" action="/admin-help-store" enctype="multipart/form-data">
                        @csrf
                        @if(Session::has('help_text_saved'))
                            <p class="alert alert-success">{{ Session::get('help_text_saved') }}</p>
                        @endif
                        <div class="position-relative form-group">
                            <div id="toolbar"></div>
                            <div id="editor-container">
                                {!! $helpText !!}
                            </div>
                            <input type="hidden" name="help-text" >
                        </div>
                        @if ($errors->first('help-text'))
                            <div class="alert   alert-danger">
                                {{ $errors->first('help-text') }}
                            </div>
                        @endif

                        <button class="mt-1 btn btn-success">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        var quill = new Quill('#editor-container', {
            modules: {
                toolbar: [
                    ['bold', 'italic'],
                    ['link', 'blockquote', 'code-block', 'image'],
                    [{ list: 'ordered' }, { list: 'bullet' }]
                ]
            },
            placeholder: 'Compose an epic...',
            theme: 'snow'
        });

        var form = document.querySelector('form');
        form.onsubmit = function() {
            // Populate hidden form on submit
            var about = document.querySelector('input[name=help-text]');
            var el = document.querySelector('.ql-editor');

            about.value = JSON.stringify(el.innerHTML);

            console.log("Submitted", $(form).serialize(), $(form).serializeArray());

            // No back end to actually submit to!
            alert('Open the console to see the submit data!')
            return false;
        };
    </script>
@endsection
