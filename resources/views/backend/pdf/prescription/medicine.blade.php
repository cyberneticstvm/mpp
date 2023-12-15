@extends("backend.pdf.prescription.base")
@section("content")
<div class="row mt-3">
    <p>Drug / Medicine Details</p>
    <div class="border" style="width: 10%;"></div>
    <table class="table mt-1" width="100%">
        <tr>
            <th class="text"><strong>SL</strong></th>
            <th class="text"><strong>Medicine</strong></th>
            <th class="text"><strong>Qty</strong></th>
            <th class="text"><strong>Dosage</strong></th>
            <th class="text"><strong>Duration</strong></th>
            <th class="text"><strong>Notes</strong></th>
        </tr>
        @forelse($consultation->medicines as $key => $item)
        <tr>
            <td class="text">{{ $key + 1 }}.</td>
            <td class="text">
                {{ $item->medicine->name }}
            </td>
            <td class="text">
                {{ $item->qty }}
            </td>
            <td class="text">
                {{ $item->dosage }}
            </td>
            <td class="text">
                {{ $item->duration }}
            </td>
            <td class="text">
                {{ $item->notes }}
            </td>
        </tr>
        @empty
        <tr>
            <td class="text">NA</td>
            <td class="text">NA</td>
            <td class="text">NA</td>
            <td class="text">NA</td>
            <td class="text">NA</td>
            <td class="text">NA</td>
        </tr>
        @endforelse
    </table>
</div>
@endsection