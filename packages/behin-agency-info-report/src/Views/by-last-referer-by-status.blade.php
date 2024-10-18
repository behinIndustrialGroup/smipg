@extends('layouts.app')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>کارشناس</th>
                <th>تعداد کل</th>
                <th>صادر شده</th>
                <th>درحال بررسی</th>
                <th>منقضی شده</th>
                <th>جدید</th>
                <th>فاقد پروانه</th>
                <th>در حال تکمیل</th>
            </tr>
        </thead>
        <tbody>
            @foreach (collect($data)->sortByDesc('total_centers') as $row)
                <tr>
                    <td>{{ $row->last_referral }}</td>
                    <td>{{ $row->total_centers }}</td>
                    <td>{{ $row->issued }}</td>
                    <td>{{ $row->under_review }}</td>
                    <td>{{ $row->expired }}</td>
                    <td>{{ $row->new }}</td>
                    <td>{{ $row->without_license }}</td>
                    <td>{{ $row->in_progress }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawCharts);
        google.charts.setOnLoadCallback(drawCharts2);
        google.charts.setOnLoadCallback(drawCharts3);
        google.charts.setOnLoadCallback(drawCharts4);
        google.charts.setOnLoadCallback(drawCharts5);

        function drawCharts() {
            var data = google.visualization.arrayToDataTable([
                ['استان', 'تعداد کل'],
                @foreach (collect($data)->sortByDesc('total_centers') as $row)
                    ['{{ $row->last_referral }}',
                        {{ $row->total_centers }},
                    ],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'آمار وضعیت مراکز در استان‌ها',
                },
                hAxis: {
                    title: 'استان',
                    minValue: 0,
                    slantedText: true,
                    slantedTextAngle: 90,
                },
                vAxis: {
                    title: 'تعداد مراکز',
                },
                height: 600,
                //isStacked: true // نمودار انباشته
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        function drawCharts2() {
            var data = google.visualization.arrayToDataTable([
                ['استان', 'صادر شده', ],
                @foreach (collect($data)->sortByDesc('issued') as $row)
                    ['{{ $row->last_referral }}',
                        {{ $row->issued }},
                    ],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'آمار وضعیت مراکز در استان‌ها',
                },
                colors: ['green'],
                hAxis: {
                    title: 'استان',
                    minValue: 0,
                    slantedText: true,
                    slantedTextAngle: 90,
                },
                vAxis: {
                    title: 'تعداد مراکز',
                },
                height: 600,
                //isStacked: true // نمودار انباشته
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_2'));
            chart.draw(data, options);
        }

        function drawCharts3() {
            var data = google.visualization.arrayToDataTable([
                ['استان', 'درحال بررسی و در حال تکمیل', ],
                @foreach (collect($data)->sortByDesc('under_review') as $row)
                    ['{{ $row->last_referral }}',
                        {{ $row->in_progress + $row->under_review }},
                    ],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'آمار وضعیت مراکز در استان‌ها',
                },
                colors: ['#f5c945'],
                hAxis: {
                    title: 'استان',
                    minValue: 0,
                    slantedText: true,
                    slantedTextAngle: 90,
                },
                vAxis: {
                    title: 'تعداد مراکز',
                },
                height: 600,
                //isStacked: true // نمودار انباشته
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_3'));
            chart.draw(data, options);
        }

        function drawCharts4() {
            var data = google.visualization.arrayToDataTable([
                ['استان', 'منقضی و بدون پروانه', ],
                @foreach (collect($data)->sortByDesc('without_license') as $row)
                    ['{{ $row->last_referral }}',
                        {{ $row->without_license + $row->expired }},
                    ],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'آمار وضعیت مراکز در استان‌ها',
                },
                colors: ['red'],
                hAxis: {
                    title: 'استان',
                    minValue: 0,
                    slantedText: true,
                    slantedTextAngle: 90,
                },
                vAxis: {
                    title: 'تعداد مراکز',
                },
                height: 600,
                //isStacked: true // نمودار انباشته
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_4'));
            chart.draw(data, options);
        }
        function drawCharts5() {
            var data = google.visualization.arrayToDataTable([
                ['استان', 'جدید', ],
                @foreach (collect($data)->sortByDesc('new') as $row)
                    ['{{ $row->last_referral }}',
                        {{ $row->new }},
                    ],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'آمار وضعیت مراکز در استان‌ها',
                },
                colors: ['blue'],
                hAxis: {
                    title: 'استان',
                    minValue: 0,
                    slantedText: true,
                    slantedTextAngle: 90,
                },
                vAxis: {
                    title: 'تعداد مراکز',
                },
                height: 600,
                //isStacked: true // نمودار انباشته
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_5'));
            chart.draw(data, options);
        }
    </script>
    <div id="chart_div" style="height: 600px; min-width: 700px;"></div>
    <div id="chart_div_2" style="height: 600px; min-width: 700px;"></div>
    <div id="chart_div_3" style="height: 600px; min-width: 700px;"></div>
    <div id="chart_div_4" style="height: 600px; min-width: 700px;"></div>
    <div id="chart_div_5" style="height: 600px; min-width: 700px;"></div>
@endsection
