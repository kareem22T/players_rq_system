<?php

namespace App\Http\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;

class ApplicantsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected Builder $query;

    /**
     * ApplicantsExport constructor.
     *
     * @param Builder $query
     */
    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->query;
    }

    /**
     * @param mixed $applicant
     * @return array
     */
    public function map($applicant): array
    {
        // Customize this section to map desired model attributes to Excel columns
        return [
            $applicant->id,
            $applicant->name,
            $applicant->phone,
            $applicant->sec_phone ?? '', // Handle potential null value for sec_phone
            $applicant->code,
            $applicant->age_group,
            $applicant->position == 1 ? "مهاجم" :
            ($applicant->position == 2 ? "خط وسط" :
            ($applicant->position == 3 ? "مدافع" : "حارس")),
            $applicant->phase == 1 ? "مرحلة اولي" :
            ($applicant->phase == 2 ? "مرحلة ثانية" :
            ($applicant->phase == 3 ? "مرحلة ثالثة" : "مرفوض")),
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Customize this section to define the exact column headings you want
        return [
            'ID',
            'Name',
            'Phone',
            'Secondary Phone',
            'Code',
            'Age Group',
            'Position',
            'Phase',
        ];
    }
}
