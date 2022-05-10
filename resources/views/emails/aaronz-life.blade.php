<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Join Aaronz Life</title>
</head>
<body style="font-family: calibri; background-color: azure;" >
<h2 style="text-align: center; background-color: black; color: #fff; margin: 0; padding: 1rem;">Join Aaronz Life Details</h2>

<div style="padding: 1rem; margin: 0 auto; width: 90%; max-width: 700px">

    <div style="width: max-content; margin: 0 auto;">
        @if($name !='')
            Name: <strong>{{ $name}}</strong> <br>
        @endif
        @if($email !='')
            Email: <strong>{{ $email}}</strong> <br>
        @endif
        @if($mobile !='')
            Mobile: <strong>{{ $mobile}}</strong> <br>
        @endif
    </div>
    <center>
        <h3>{{ $description }}</h3>
    </center>
</div>
<hr />
</body>
</html>
