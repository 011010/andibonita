<?php

namespace App\Imports;

use App\Models\Alumno;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumnosImport implements ToModel, WithHeadingRow,  WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Alumno([
            'semestre' => $row['semestre'],
            'grupo' => $row['grupo'],
            'numerodecontrol' => $row['numerodecontrol'],
            'nombre' => $row['nombre'],
            'a_paterno' => $row['a_paterno'],
            'a_materno' => $row['a_materno'],
        ]);
    }

    public function batchSize(): int
    {
        return 2;
    }
    public function chunkSize(): int
    {
        return 2;
    }
}

