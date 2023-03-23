<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist de Seguimiento de Menus</title>
</head>
<body>
    <h1 style="text-align: center;">Checklist de seguimiento menus</h1>
    <h4 style="text-align: center;">El cliente {{ $checklist->customer }} ha confirmado que su proyecto esta {{intval($checklist->aprobed) === 1 ? 'Aprobado' : 'Declinado' }}</h4>
    <h4 style="text-align: center;">El proyecto fue revisado por: {{ $checklist->approver }} </h4>

    @if (intval($checklist->aprobed) !== 1)
        <h3 style="text-align: center;">Observaciones del cliente:</h3>
        <p style="text-align: center;">{{$checklist->message}}</p>

    @endif

    @if (intval($checklist->aprobed) === 1)
        <img src="{{$gifCelebration}}" alt="Aprobado" style="display: block; margin-left:auto; margin-right:auto;">

    @endif



</body>
</html>
