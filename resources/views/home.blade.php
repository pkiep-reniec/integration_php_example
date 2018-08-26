<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>RENIEC IDaaS - Example PHP</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center">RENIEC IDaaS</h1>
            <h4 class="text-center">Auth Result</h4>

            <div class="col-sm-12">
                <p><b>DNI:</b> {{ $oUser->doc }}</p>
                <p><b>Primer nombre:</b> {{ $oUser->first_name }}</p>
                <p><b>Teléfono:</b> {{ $oUser->phone_number }}</p>
                <p><b>Teléfono verificado:</b> {{ $oUser->phone_number_verified }}</p>
                <p><b>Email:</b> {{ $oUser->email }}</p>
                <p><b>Email verificado:</b> {{ $oUser->email_verified }}</p>
                <p><b>Sub:</b> {{ $oUser->sub }}</p>
            </div>

            <div class="col-sm-12 text-center">
                <a href="{{ $logout }}" class="btn btn-danger">Salir</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
