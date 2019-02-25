<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $rows)
    {
      if($rows['mssv'] != null){
        return new Student([
            'mssv' => trim($rows['mssv']),
            'pwd' => sha1(trim($rows['password'])),
            'name' => trim($rows['name']),
            'email' => trim($rows['mssv']) . "@vnu.edu.vn",
        ]);
      }
    }
}
