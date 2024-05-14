<?php

namespace App\Imports;

use App\Models\Tutorado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TutoradosImport implements ToModel, WithHeadingRow,  WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tutorado([
            //
            'semestre' => $row['semestre'],
            'grupo' => $row['grupo'],
            'carrera' => $row['carrera'],
            'numerocontrol' => $row['numerocontrol'],
            'nombre' => $row['nombre'],
            'a_paterno' => $row['a_paterno'],
            'a_materno' => $row['a_materno'],
            'correoelectronico' => $row['correoelectronico'],
            'contraseña' => $row['contrasena'],
        ]);
 
    }
    public function batchSize(): int
    {
        return 500;
    }
    public function chunkSize(): int
    {
        return 500;
    }

}
