@extends("backend.pdf.prescription.base")
@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center">
            <img src="{{ './'.getPrescriptionHeader()['logo'] }}" width="25%" />
        </div>
        <div class="col-12 text-center mt-3">
            Address: {!! getPrescriptionHeader()['address'] !!}
        </div>
        <div class="col-12 text-center mt-1">
            Contact Number: {!! nl2br(getPrescriptionHeader()['contact_number']) !!}
        </div>
    </div>
    <div class="row mt-5">
        <p>Patient Details</p>
        <div class="border" style="width: 10%;"></div>
        <table class="table table-bordered">
            <tr>
                <td width="50%">
                    <label>Name:</label><br />
                    <desc>
                        {{ $consultation->patient->patient_name }}
                    </desc>
                </td>
                <td width="30%">
                    <label>Age / Gender:</label><br />
                    <desc>
                        {{ $consultation->patient->age.' '.$consultation->patient->old.' / '. ucfirst($consultation->patient->gender) }}
                    </desc>
                </td>
                <td width="25%">
                    <label>Contact:</label><br />
                    <desc>
                        {{ $consultation->patient->mobile }}
                    </desc>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <label>Patient ID:</label><br />
                    <desc>
                        {{ $consultation->patient->patient_id }}
                    </desc>
                </td>
                <td width="50%">
                    <label>Address:</label><br />
                    <desc>
                        {{ $consultation->patient->address }}
                    </desc>
                </td>
            </tr>
        </table>
    </div>
    <div class="row mt-5">
        <p>Clinical Details</p>
        <div class="border" style="width: 10%;"></div>
        <table class="table table-bordered mt-3">
            <tr>
                <td width="50%">
                    <desc>Medical History:</desc><br />
                    <label>
                        {{ $consultation->medical_history }}
                    </label>
                </td>
                <td width="50%">
                    <desc>Examination:</desc><br />
                    <label>
                        {{ $consultation->examination }}
                    </label>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection