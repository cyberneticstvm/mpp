<!DOCTYPE html>
<html lang="en">

<head>
    <title>Medical Prescription Pro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
            text-align: justify !important;
        }

        .border {
            border-bottom: 5px solid #205482;
        }
    </style>
</head>

<body>
    @yield("content")
</body>

</html>