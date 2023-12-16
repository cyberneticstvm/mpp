<!DOCTYPE html>
<html lang="en">

<head>
    <title>Medical Prescription Pro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        .text {
            font-weight: 300;
            font-size: 13px;
            text-align: justify;
            margin-right: 5px;
        }

        .border {
            border-bottom: 5px solid orangered;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .mt-3 {
            margin-top: 3%;
        }

        .mt-5 {
            margin-top: 5%;
        }

        td,
        th {
            font-size: 10px;
            text-align: left;
            padding: 3px 0;
        }

        .mt-1 {
            margin-top: 1%;
        }

        .me-3 {
            margin-right: 3%;
        }

        @page {
            margin-bottom: 5px;
        }

        qrcode {
            position: fixed;
            bottom: 50;
            right: 10;
        }

        footer {
            position: fixed;
            bottom: 5;
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
        <div class="border mt-3"></div>
        @yield("content")
        <!--<qrcode>
            <img src="data:image/png;base64, {!! $qrcode !!}">
        </qrcode>-->
        <footer>
            <table width="100%">
                <tr>
                    <td class="text">Printed at: {{ date('d, F Y h:i a') }}</td>
                    <td class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Powered by: <a style="text-decoration:none;" href="https://medicalprescription.pro" target="_blank">Medical Prescription Pro</a></td>
                </tr>
            </table>
        </footer>
    </div>
</body>

</html>