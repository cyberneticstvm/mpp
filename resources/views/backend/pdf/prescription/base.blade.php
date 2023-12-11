<!DOCTYPE html>
<html lang="en">

<head>
    <title>Medical Prescription Pro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/assets/css/bootstrap.css') }}">
    <script src="{{ asset('/backend/assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <style>
        body,
        p {
            font-family: 'Montserrat', sans-serif;
        }

        p {
            font-size: 1.2rem;
            color: grey;
        }

        label {
            font-weight: 300;
            color: #000;
        }

        desc {
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
            color: black;
        }

        .text {
            font-family: 'Montserrat', sans-serif;
            font-weight: 300;
            font-size: 13px;
            text-align: justify;
        }

        .border {
            border-bottom: 5px solid #205482;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
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
        @yield("content")
    </div>
</body>

</html>