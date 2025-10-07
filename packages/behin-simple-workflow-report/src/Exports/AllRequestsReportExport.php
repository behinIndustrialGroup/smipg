<?php

namespace Behin\SimpleWorkflowReport\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AllRequestsReportExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(protected Collection $rows)
    {
    }

    public function collection(): Collection
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return [
            'شماره پرونده',
            'نام کامل',
            'شماره موبایل',
            'کدملی',
            'تلفن',
            'شماره صنفی',
            'نام واحد صنفی',
            'استان محل نصب',
            'اطلاعات متقاضی تایید است',
            'آخرین وضعیت درخواست',
        ];
    }

    public function map($row): array
    {
        if ($row instanceof Collection) {
            $row = $row->toArray();
        } elseif (is_object($row)) {
            $row = (array) $row;
        }

        return [
            $row['case_number'] ?? null,
            $row['fullname'] ?? null,
            $row['mobile'] ?? null,
            $row['national_id'] ?? null,
            $row['tel'] ?? null,
            $row['guild_number'] ?? null,
            $row['guild_name'] ?? null,
            $row['city'] ?? collect([
                $row['province_name'] ?? null,
                $row['city_name'] ?? null,
            ])->filter()->implode(' - '),
            $row['customer_info_is_aproved'] ?? null,
            $row['last_status'] ?? null,
        ];
    }
}
