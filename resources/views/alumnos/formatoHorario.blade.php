<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mx-auto mt-5">
        <div class="w-full">
            <div>
                <img src="{{ asset('img/logo-tecnm.png') }}" class="justify-start" alt="logo tecnm" width="190" heigh="190">
                <img src="{{ asset('img/logo-ita.png') }}" class="justify-end" alt="logo ita" width="100" heigh="100">
            </div>
        </div> 

        <div class="mt-5">
            <table class="w-full">
                <tbody>
                    <tr>
                        <td>
                            <div>
                                <p>Nombre: <span class="underline">{{ $nameAlumno }}</span></p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p>Numero de Control: <span class="underline">{{ $nControl }}</span></p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div>
                                <p>Carrear: <span class="underline">{{ $carrera }}</span></p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p>Semestre: <span class="underline">{{ $semestre }}</span></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Periodo: <span class="underline">{{ $periodo.' - '.$year  }}</span></p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <table class="w-full border border-black">
                <thead>
                    <tr>
                        <th class="border border-black text-center">Materia</th>
                        <th class="border border-black text-center">Hora</th>
                        <th class="border border-black text-center">Aula</th>
                        <th class="border border-black text-center">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $item)
                    <tr class="">
                        <td class="border border-black">{{ $item->nombreCurso}} <br> <span class="text-xs -mt-5">Profesor: {{$item->name.' '.$item->lastname }}</span> </td>
                        <td class="border border-black text-center">{{ $item->horario }}</td>
                        <td class="border border-black text-center">{{ $item->aula }}</td>
                        <td class="border border-black text-center"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>