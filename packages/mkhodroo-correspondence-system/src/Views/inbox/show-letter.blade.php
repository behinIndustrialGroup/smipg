@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="row p-3">

        </div>
    </div>
    <div class="row">
        <div class="col-sm-2 card">
            <ul class="navbar-nav p-1">
                <li class="nav-item">
                    <span class="btn btn-default btn-sm" onclick="numbering()">{{ __('Numbering') }}</span>
                    <hr>
                </li>
                <li class="nav-item">
                    @if ($letter_info->sign_id)
                        <span class="btn btn-default btn-sm" onclick="unsigning()">{{ __('Unsigning') }}</span>
                        <hr>
                    @else
                        <select name="sign_id" id="" class="form-control">
                            @foreach ($signs as $sign)
                                <option value="{{ $sign->id }}">{{ $sign->name }}</option>
                            @endforeach
                        </select>
                        <span class="btn btn-default btn-sm" onclick="siging()">{{ __('Signing') }}</span>
                        <hr>
                    @endif
                </li>
                <li class="nav-item">
                    <span class="btn btn-default btn-sm" onclick="jumpToModal()">{{ __('Jump To') }}</span>
                    <hr>
                </li>
            </ul>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <form action="javascript:void()" id="create-form" class="form-control">
                    @csrf
                    <input type="hidden" name="inbox_id" id="" class="form-control" value="{{ $inbox_id ?? '' }}">
                    <input type="hidden" name="id" id="" class="form-control" value="{{ $letter_id ?? '' }}">
                    @php
                        $readonly = $letter_info->sign_id ? 'readonly' : '';
                    @endphp
                    <div class="row">
                        <div class="col-sm-2">{{ __('Title') }}:</div>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="" class="form-control"
                                value="{{ $letter_info->title ?? '' }}" placeholder="{{ __('Title') }}" {{ $readonly }}>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-2">{{ __('Receiver') }}:</div>
                        <div class="col-sm-10">

                            @if ($letter_info->receivers())
                                @foreach ($letter_info->receivers() as $receiver)
                                    <input type="text" name="receivers[]" id="" class="form-control"
                                        list="receivers" value="{{ $receiver->name }}" {{ $readonly }}>
                                @endforeach
                                <input type="text" name="receivers[]" id="" class="form-control"
                                    list="receivers" {{ $readonly }}>
                            @else
                                <input type="text" name="receivers[]" id="" class="form-control"
                                    list="receivers" {{ $readonly }}>
                            @endif
                            <datalist id="receivers">
                                @foreach ($receiver_options as $option)
                                    <option value="{{ $option->user }} {{ $option->role }}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <hr>

                    @if ($letter_info->sign_id)
                        <div class="alert alert-danger">{{ __('Letter Was Signed') }}</div>
                        <button onclick="download({{ $letter_id ?? '' }})"
                            class="form-control">{{ __('Download Letter Body') }}</button>
                    @else
                        {{ __('Body') }}:
                        <button onclick="download({{ $letter_id ?? '' }})"
                            class="form-control">{{ __('Download Template') }}</button>
                        <input type="file" name="file" id="" class="form-control">
                    @endif

                    {{-- <a href="ms-word:ofe|u|http://localhost/smipg/public/file.docx">test</a> --}}

                </form>
                @if (!$letter_info->sign_id)
                    <button class="btn btn-success" onclick="submit()">{{ __('Create') }}</button>
                @endif
            </div>
        </div>
        <div class="col-sm-4 card">
            <button onclick="history()">{{ __('History') }}</button>
            <div id="history" class="card">

            </div>
        </div>
        <div class="col-sm-4 card">
            <button onclick="preview()">{{ __('Preview') }}</button>
            <div id="preview" class="card">

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        function submit() {
            var fd = new FormData($('#create-form')[0]);
            send_ajax_formdata_request(
                "{{ route('atmn.letter.create') }}",
                fd,
                function(data) {
                    console.log(data);
                    $('input[name="id"]').val(data.id);
                    show_message("{{ __('Created') }}")
                }
            )
        }
        $('#summernote').summernote({
            height: 200
        });

        function download(id) {
            var url = "{{ route('atmn.letter.download', ['id' => 'id']) }}";
            url = url.replace('id', id);
            window.open(url);
        }

        function numbering() {
            var fd = new FormData();
            fd.append('letter_id', $('input[name="id"]').val());
            send_ajax_formdata_request(
                "{{ route('atmn.activity.numbering') }}",
                fd,
                function(res) {
                    console.log(res);
                    show_message("{{ __('Numbered') }}")
                }
            )
        }

        function siging() {
            var fd = new FormData();
            fd.append('letter_id', $('input[name="id"]').val());
            fd.append('sign_id', $('select[name="sign_id"]').val());
            send_ajax_formdata_request(
                "{{ route('atmn.activity.signing') }}",
                fd,
                function(res) {
                    console.log(res);
                    show_message("{{ __('Signed') }}")
                    location.reload()
                }
            )
        }

        function unsigning() {
            var fd = new FormData();
            fd.append('letter_id', $('input[name="id"]').val());
            send_ajax_formdata_request(
                "{{ route('atmn.activity.unsigning') }}",
                fd,
                function(res) {
                    console.log(res);
                    show_message("{{ __('Unsigned') }}")
                    location.reload()
                }
            )
        }

        function jumpToModal() {
            var fd = new FormData();
            fd.append('inbox_id', $('input[name="inbox_id"]').val());
            fd.append('letter_id', $('input[name="id"]').val());
            send_ajax_formdata_request(
                "{{ route('atmn.jump.form') }}",
                fd,
                function(body) {
                    open_admin_modal_with_data(body)
                }
            )
        }

        function preview() {
            var url = "{{ route('atmn.letter.preview', ['id' => 'id']) }}";
            url = url.replace('id', $('input[name="id"]').val());
            send_ajax_get_request(
                url,
                function(data) {
                    $('#preview').html(data)
                }
            )
        }

        function history() {
            var url = "{{ route('atmn.activity.get', ['letter_id' => 'letter_id']) }}";
            url = url.replace('letter_id', $('input[name="id"]').val());
            send_ajax_get_request(
                url,
                function(data) {
                    console.log(data);
                    data.forEach(function(item){
                        $('#history').append(`<p><span>${item.shDate} </span>${item.string}</p>`);
                    })
                }
            )
        }
    </script>
@endsection
