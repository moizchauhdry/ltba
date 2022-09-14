<?php

namespace App\Imports;

use App\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MemberImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\rowbase\Eloquent\Model|null
    */
    public function model(array $row)
    {  
        dd($row['Membership']);              
        return new Member([
            'mem_no' => $row['Membership'],
            'name'  => $row['Name'], 
            'cnic_no'  => $row['CNIC'], 
            'mem' => $row['Life/ORD'], 
            'membership_based_on' => $row['QLY'], 
            'city' => $row['CITY'], 
            'contact_no' => $row['CELL # '], 
            'gender' => $row['GENDER'], 
            'birth_date' => $row['D-O-B'], 
            'residential_address' => $row['ADDRESS'], 
            'mem_status' => 1, 
        ]);
    }
}
