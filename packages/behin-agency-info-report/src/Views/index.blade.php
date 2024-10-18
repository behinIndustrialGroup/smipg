@extends('layouts.app')

@section('content')
<div class="row card mt-2 p-2">
    <h2 class="text-center mb-4">{{ trans('Reports') }}</h2>
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white text-center">
                    <h5>{{ trans('Report by province by status') }}</h5>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                    <p class="card-text">{{ trans('View reports categorized by province and status.') }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('agencyInfoReport.byProvince.byStatus') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> {{ trans('View Report') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white text-center">
                    <h5>{{ trans('Report by last referral by status') }}</h5>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-user-check fa-3x mb-3"></i>
                    <p class="card-text">{{ trans('View reports based on the last referral status.') }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('agencyInfoReport.byLastReferer.byStatus') }}" class="btn btn-info">
                        <i class="fas fa-arrow-right"></i> {{ trans('View Report') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@endsection
