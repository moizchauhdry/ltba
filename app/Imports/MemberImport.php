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
        $member = Member::updateOrCreate(['mem_no' => $row['membership']], [
            'mem_no' => $row['membership'],
            'name'  => $row['name'],
            'cnic_no'  => $row['cnic'],
            'mem' => $row['lifeord'],
            'membership_based_on' => $row['qly'],
            'city' => $row['city'],
            'contact_no' => $row['cell'],
            'gender' => $row['gender'],
            'birth_date' => $row['d_o_b'],
            'residential_address' => $row['residential_address'],
            'mem_status' => 1,
        ]);

        return $member;
    }
}
