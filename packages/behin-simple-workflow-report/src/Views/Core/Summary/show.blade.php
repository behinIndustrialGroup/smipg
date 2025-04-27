@extends('layouts.app')


@section('title')
    خلاصه گزارش فرایند {{ $process->name }}
@endsection

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('SimpleWorkflowView::Core.Partial.back-btn')
                <div class="card">
                    <div class="card-header">لیست پرونده های فرآیند {{ $process->name }}</div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="draft-list">
                                <thead>
                                    <tr>
                                        {{-- <th>ردیف</th> --}}
                                        <th class="d-none">شناسه</th>
                                        <th>شماره پرونده</th>
                                        <th>ایجاد کننده</th>
                                        <th>نام متقاضی</th>
                                        <th>کدملی</th>
                                        <th>رسته</th>
                                        <th>شناسه صنفی</th>
                                        <th>آخرین وضعیت</th>
                                        <th>تاریخ ایجاد</th>
                                        <th>اقدام</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($process->cases as $case)
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td class="d-none">{{ $case->id }}</td>
                                            <td>{{ $case->number }} <a href="{{ route('simpleWorkflowReport.summary-report.edit', [ 'summary_report' => $case->id ]) }}"><i class="fa fa-external-link"></i></a></td>
                                            <td>{{ $case->creator()?->name }}</td>

                                            <td>{{ $case->getVariable('fullname') }}</td>
                                            <td>{{ $case->getVariable('national_id') }}</td>
                                            <td>{{ $case->getVariable('category') }}</td>
                                            <td>{{ $case->getVariable('guild_number') }}</td>
                                            @php
                                                $w = '';
                                                foreach ($case->whereIs() as $inbox) {
                                                    $w .= $inbox->task->name ?? '';
                                                    $w .= '(' . getUserInfo($inbox->actor)?->name . ')';
                                                    $w .= '<br>';
                                                }
                                            @endphp
                                            <td>{!! $w !!}</td>
                                            <td dir="ltr">{{ toJalali($case->created_at)->format('Y-m-d H:i') }}</td>
                                            <td><a href="{{ route('simpleWorkflowReport.summary-report.edit', [ 'summary_report' => $case->id ]) }}"><button class="btn btn-primary btn-sm">{{ trans('fields.Show More') }}</button></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        initial_view();
        $('#draft-list').DataTable({
            "order": [
                [1, "desc"]
            ],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Persian.json"
            }
        });
    </script>
@endsection
