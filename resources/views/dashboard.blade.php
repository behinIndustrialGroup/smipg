@extends('layouts.app')

@section('title')
    داشبورد
@endsection

@section('content')
    {{-- @include('user-profile.partial-views.user-profile-div') --}}
    <div class="row card m-2 p-2">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-warning text-white text-center">
                    <h5>{{ trans('تکمیل مدارک') }}</h5>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-file fa-3x mb-3"></i>
                    <p class="card-text">{{ trans('جهت تکمیل مدارک، به صفحه پروفایل مراجعه کنید') }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('user-profile.profile') }}" class="btn btn-warning">
                        <i class="fas fa-arrow-right"></i> {{ trans('رفتن به صفحه پروفایل') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
