<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// usar la clase Pdf cuando instales barryvdh/laravel-dompdf
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;


class AlumnosPdfController extends Controller
{
    public function download(Request $request)
    {
        // ejemplo simple: traer todos los alumnos usando el scope que ya definiste
        $alumnos = User::alumnos()->orderBy('id')->get([
            'nombres', 'apellidos', 'email', 'dni', 'carrera', 'comision', 'telefono'
        ]);

        // transformar nombres/apellidos a string si son arrays (tu esquema)
        $alumnos = $alumnos->map(function ($u) {
            $nombres = is_array($u->nombres) ? implode(' ', $u->nombres) : ($u->nombres ?? '');
            $apellidos = is_array($u->apellidos) ? implode(' ', $u->apellidos) : ($u->apellidos ?? '');
            return [
                'nombre_completo' => trim($nombres . ' ' . $apellidos),
                'email' => $u->email,
                'dni' => $u->dni,
                'carrera' => $u->carrera,
                'comision' => $u->comision,
                'telefono' => $u->telefono,
            ];
        });

        // Cargar vista blade 'alumnos.pdf' (la crearás en resources/views/alumnos/pdf.blade.php)
        $pdf = Pdf::loadView('alumnos.pdf', ['alumnos' => $alumnos]);

        // fuerza descarga:
        return $pdf->download('alumnos-listado.pdf');
    }
}
