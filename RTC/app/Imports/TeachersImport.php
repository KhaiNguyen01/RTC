<?php

namespace App\Imports;

use App\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $rows)
    {
      if($rows['usr'] != null){
        return new Teacher([
            'usr' => $rows['usr'],
            'pwd' => sha1($rows['password']),
            'name' => $rows['name'],
            'email' => $rows['usr'] . "@vnu.edu.vn",
        ]);
      }
    }
}
