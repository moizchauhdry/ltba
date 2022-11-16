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
        // dd($row);
        $member = Member::updateOrCreate(['mem_no' => $row['membership']], [
            'mem_no' => $row['membership'],
            'name'  => $row['name'],
            'father_name'  => $row['father_name'],
            'cnic_no'  => $row['cnic'],
            'mem' => $row['lifeord'],
            'membership_based_on' => $row['qly'],
            'city' => $row['city'],
            'contact_no' => $row['cell'],
            'gender' => $row['gender'],
            'birth_date' => $row['d_o_b'],
            // 'fees' => $row['fees'],
            'residential_address' => $row['residential_address'],
            'office_address' => $row['office_address'],
            'mem_reg_date' => $row['membership_reg_date'],
            'qualification' => $row['qualification'],
            'mem_status' => 1,
        ]);

        return $member;
    }
}
