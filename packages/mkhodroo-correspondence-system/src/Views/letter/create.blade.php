@extends('layouts.app')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <form action="javascript:void()" id="create-form" class="form-control">
                    @csrf
                    <input type="text" name="id" id="" class="form-control" value="{{ $letter_id ?? '' }}">
                    
                    {{ __('Title') }}:
                    <input type="text" name="title" id="" class="form-control"
                        placeholder="{{ __('Title') }}">
                    {{ __('Receiver') }}:
                    <input type="text" name="receivers[]" id="" class="form-control" list="receivers">
                    <datalist id="receivers">
                        @foreach ($receiver_options as $option)
                            <option value="{{ $option->user }} {{ $option->role }}">
                        @endforeach
                    </datalist>
                    {{ __('Body') }}:
                    <button onclick="download({{ $letter_id ?? ''}})">download</button>
                    {{-- <a href="ms-word:ofe|u|http://localhost/smipg/public/file.docx">test</a> --}}
                    <input type="file" name="file" id="" class="form-control">
                </form>
                <button class="btn btn-success" onclick="submit()">{{ __('Create') }}</button>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <button class="btn btn-info">{{ __('Numbering') }}</button>
                <button class="btn btn-info">{{ __('Jump To') }}</button>
            </div>
            <div class="card">
                <div id="preview">

                </div>
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
        function download(id){
            var url = "{{route('atmn.letter.download', ['id' => 'id'])}}";
            url = url.replace('id', id);
            window.open(url);
        }
    </script>
@endsection
