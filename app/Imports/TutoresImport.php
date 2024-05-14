<?php

namespace App\Imports;

use App\Models\Tutore;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TutoresImport implements ToModel, WithHeadingRow,  WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tutore([
            'nombres' => $row['nombres'],
            'a_paterno' => $row['a_paterno'],
            'a_materno' => $row['a_materno'],
            'division' => $row['division'],
            'teléfono' => $row['telefono'],
            'perfil' => $row['perfil'],
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
