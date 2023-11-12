@extends('layouts.app')

@section('style')
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <form action="{{ route('atmn.letter.selectLetterTemplate') }}" id="create-form" class="form-control">
                    @csrf
                    {{ __('Template') }}:
                    <select name="template_id" id="" class="select2 form-control">
                        @foreach ($templates as $template)
                            <option value="{{ $template->id }}">{{ $template->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success" >{{ __('Create') }}</button>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script></script>
@endsection
