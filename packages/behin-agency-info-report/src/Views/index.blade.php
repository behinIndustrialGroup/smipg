@extends('layouts.app')

@section('content')
    <div class="row card">
        <a href="{{ route('agencyInfoReport.byProvince.byStatus') }}" class="m-2">
            <button class="btn btn-default">
                {{ trans('Report by province by status') }}
            </button>
        </a>
    </div>
@endsection
