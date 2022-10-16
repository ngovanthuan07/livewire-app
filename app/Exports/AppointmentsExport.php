<?php

namespace App\Exports;

use App\Models\Appointment;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AppointmentsExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $selectedRows;

    public function __construct($selectedRows)
    {
        $this->selectedRows = $selectedRows;
    }

    public function map($appointment): array
    {
        return [
            $appointment->id,
            $appointment->client->name,
            $appointment->date,
            $appointment->time,
            $appointment->status,
        ];
    }

    public function headings(): array
    {
        return [
            '#ID',
            'Client Name',
            'Date',
            'Time',
            'Status',
        ];
    }

    public function query()
    {
        return Appointment::with('client:id,name')->whereIn('id', $this->selectedRows);
    }
}
