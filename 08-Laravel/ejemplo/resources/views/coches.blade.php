<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Lista de coches</h1>
        <table class="table text-center table-bordered border-secundary table-hover table-light">
            <thead class="table-dark">
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($coches as $coche)
                    <tr class='table-primary'>
                        <td class='table-secondary'>{{ $coche[0] }}</td>
                        <td class='table-secondary'>{{ $coche[1] }}</td>
                        <td class='table-secondary'>{{ $coche[2] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>