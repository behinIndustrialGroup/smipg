@extends('layouts.app')

@section('title', 'لیست تمام درخواست‌ها')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h5 class="mb-0">لیست تمام درخواست‌ها</h5>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="badge bg-light text-primary">{{ number_format($rows->total()) }} مورد</span>
                            <form method="GET" action="{{ route('simpleWorkflowReport.all-requests.export') }}">
                                @foreach(($filters ?? []) as $key => $value)
                                    @continue($value === null || $value === '')
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <button type="submit" class="btn btn-sm btn-light text-primary fw-semibold">
                                    خروجی اکسل
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                            $filters = $filters ?? [];
                            $hasActiveFilters = collect($filters)->except(['per_page'])->filter(fn($value) => $value !== null && $value !== '')->isNotEmpty();
                        @endphp

                        <div class="mb-3">
                            <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#advanced-filters" aria-expanded="{{ $hasActiveFilters ? 'true' : 'false' }}" aria-controls="advanced-filters">
                                فیلتر پیشرفته
                            </button>
                        </div>

                        <div class="collapse {{ $hasActiveFilters ? 'show' : '' }}" id="advanced-filters">
                            <div class="card card-body border-0 shadow-sm mb-4">
                                <form method="GET" action="{{ route('simpleWorkflowReport.all-requests.index') }}">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label">شماره پرونده</label>
                                            <input type="text" name="case_number" value="{{ $filters['case_number'] ?? '' }}" class="form-control" placeholder="مثال: 1234">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">نام کامل</label>
                                            <input type="text" name="fullname" value="{{ $filters['fullname'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">شماره موبایل</label>
                                            <input type="text" name="mobile" value="{{ $filters['mobile'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">شماره تلفن</label>
                                            <input type="text" name="tel" value="{{ $filters['tel'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">شماره واحد صنفی</label>
                                            <input type="text" name="guild_number" value="{{ $filters['guild_number'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">نام واحد صنفی</label>
                                            <input type="text" name="guild_name" value="{{ $filters['guild_name'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">استان محل نصب</label>
                                            <input type="text" name="city" value="{{ $filters['city'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">اطلاعات متقاضی تایید است</label>
                                            <input type="text" name="customer_info_is_aproved" value="{{ $filters['customer_info_is_aproved'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">آخرین وضعیت درخواست</label>
                                            <input type="text" name="last_status" value="{{ $filters['last_status'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">تعداد نمایش در هر صفحه</label>
                                            <select name="per_page" class="form-select">
                                                @foreach([10, 15, 25, 50, 100] as $size)
                                                    <option value="{{ $size }}" {{ ($perPage ?? 15) == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <a href="{{ route('simpleWorkflowReport.all-requests.index') }}" class="btn btn-light">پاکسازی فیلتر</a>
                                        <button type="submit" class="btn btn-primary">اعمال فیلتر</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th>شماره پرونده</th>
                                    <th>نام کامل</th>
                                    <th>شماره موبایل</th>
                                    <th>کدملی</th>
                                    <th>تلفن</th>
                                    <th>شماره صنفی</th>
                                    <th>نام واحد صنفی</th>
                                    <th>استان محل نصب</th>
                                    <th>اطلاعات متقاضی تایید است</th>
                                    <th>آخرین وضعیت درخواست</th>
                                    <th class="text-center">جزئیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($rows as $row)
                                    <tr>
                                        <td>{{ $row->number ?? '---' }}</td>
                                        <td>{{ $row->fullname ?? '---' }}</td>
                                        <td>{{ $row->mobile ?? '---' }}</td>
                                        <td>{{ $row->national_id ?? '---' }}</td>
                                        <td dir="ltr">{{ $row->tel ?? '---' }}</td>
                                        <td>{{ $row->guild_number ?? '---' }}</td>
                                        <td>{{ $row->guild_name ?? '---' }}</td>
                                        <td>{{ $row->city ?? '---' }}</td>
                                        <td>{{ $row->customer_info_is_aproved ?? '---' }}</td>
                                        <td>
                                            @foreach ($row->last_status as $last_status)
                                                {{ $last_status->task->name ?? '' }}
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('simpleWorkflowReport.all-requests.show', $row->number) }}" class="btn btn-sm btn-outline-primary px-3">
                                                مشاهده جزئیات
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="13" class="text-center text-muted">رکوردی یافت نشد.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
                            <div class="text-muted small">
                                نمایش {{ $rows->firstItem() ?? 0 }} تا {{ $rows->lastItem() ?? 0 }} از {{ number_format($rows->total()) }} رکورد
                            </div>
                            <div>
                                {{ $rows->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
