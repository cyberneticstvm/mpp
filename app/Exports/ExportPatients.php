<?php

namespace App\Exports;

use App\Models\Patient;
use App\Rules\dateDifferenceInDays;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportPatients implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
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
        $request->validate([
            'from_date' => 'required',
            'to_date' => ['required', new dateDifferenceInDays($request)],
            'profile' => 'required',
        ]);
        $fdate = Carbon::createFromFormat('d, F Y', $request->from_date)->format('Y-m-d');
        $fdate = Carbon::parse($fdate)->startOfDay();
        $tdate = Carbon::createFromFormat('d, F Y', $request->to_date)->format('Y-m-d');
        $tdate = Carbon::parse($tdate)->endOfDay();
        $patients = Patient::where('user_id', Auth::id())->where('profile_id', decrypt($request->profile))->whereBetween('created_at', [$fdate, $tdate])->latest()->get();
        return $patients->map(function ($data, $key) {
            return [
                'item_serial' =>  $key + 1,
                'item_name' => $data->patient_name,
                'item_age' => $data->patient_id,
                'item_place' => $data->age,
                'item_gender' => ucfirst($data->gender),
                'item_mobile' => $data->mobile,
                'item_address' => $data->address,
                'item_date' => $data->created_at?->format('d, F Y'),
            ];
        });
    }

    public function headings(): array
    {
        return ['SL No', 'Patient Name', 'Patient Id', 'Age', 'Gender', 'Mobile', 'Address', 'Registered On'];
    }

    public function map($data): array
    {
        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
    }
}
