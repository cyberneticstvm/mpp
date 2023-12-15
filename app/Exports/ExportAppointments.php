<?php

namespace App\Exports;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportAppointments implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $request = $this->request;
        $fdate = Carbon::createFromFormat('d, F Y', $request->from_date)->format('Y-m-d');
        $fdate = Carbon::parse($fdate)->startOfDay();
        $tdate = Carbon::createFromFormat('d, F Y', $request->to_date)->format('Y-m-d');
        $tdate = Carbon::parse($tdate)->endOfDay();
        $appointments = Appointment::where('user_id', Auth::id())->where('profile_id', decrypt($request->profile))->whereBetween('created_at', [$fdate, $tdate])->latest()->get();
        return $appointments->map(function ($data, $key) {
            return [
                'item_serial' =>  $key + 1,
                'item_name' => $data->patient_name,
                'item_age' => $data->age,
                'item_gender' => ucfirst($data->gender),
                'item_place' => $data->address,
                'item_mobile' => $data->mobile,
                'item_date' => $data->appointment_date?->format('d, F Y'),
                'item_time' => $data->appointment_time?->format('h:i a'),
            ];
        });
    }

    public function headings(): array
    {
        return ['SL No', 'Patient Name', 'Age', 'Gender', 'Place', 'Mobile', 'Appointment Date', 'Appointment Time'];
    }

    public function map($data): array
    {
        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
    }
}
