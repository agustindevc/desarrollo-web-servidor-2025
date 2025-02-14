<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('marcas.store') }}" method="post">
        <label>Marca:</label>
        <input type="text" name="marca"><br><br>
        <label>Año de fundación:</label>
        <input type="text" name="marca"><br><br>
        <label>País:</label>
        <input type="text" name="marca"><br><br>
        <input type="submit" value="Crear">
    </form>
</body>
</html>