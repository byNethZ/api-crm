<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje desde el Banco de Fotos</title>
</head>

<body>

    <div style="text-align: center; width: 80%; margin: auto;">
        <h2>Nombre del cliente: </h2>
        <p>{{ $name }}</p>

        <h2>Restaurante del cliente: </h2>
        <p>{{ $restaurant }}</p>

        <h2>Teléfono del cliente: </h2>
        <p>{{ $phone }}</p>

        <h2>Email del cliente: </h2>
        <p>{{ $email }}</p>

        <br>
        <br>

        @foreach ($photos as $photo)
            <h2>Categoria de la imagen: </h2>
            <p>{{ $photo['nombreCategoria'] }}</p>
            <h2>Nombre de la imagen: </h2>
            <p>{{ $photo['nombreImg'] }}</p>
            <h2>Nombre del platillo: </h2>
            <p>{{ $photo['nombrePlatillo'] }}</p>
            <img src="" alt="">
            <img style="width: 100%; max-width: 30rem" src="{{ $photo['srcImg'] }}" alt="{{ $photo['nombreImg']}}">
        @endforeach

        <h2>Total de imagenes</h2>
        <p>{{ count($photos) }}</p>
    </div>


</body>

</html>
