<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Listado de Alumnos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #f0f0f0; font-weight: 600; }
        thead th { font-size: 12px; }
        tbody td { font-size: 11px; }
    </style>
</head>
<body>
    <h2>Listado de Alumnos</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>DNI</th>
                <th>Carrera</th>
                <th>Comisión</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alumnos as $i => $a)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $a['nombre_completo'] }}</td>
                    <td>{{ $a['email'] }}</td>
                    <td>{{ $a['dni'] ?? '-' }}</td>
                    <td>{{ $a['carrera'] ?? '-' }}</td>
                    <td>{{ $a['comision'] ?? '-' }}</td>
                    <td>{{ $a['telefono'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
