<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'MEM#', //UNIQUE
        'name',
        'father_name',
        'gender',
        'CNIC_NO', //UNIQUE
        'city',
        'contact_no', //UNIQUE
        'address',
        'date_of_birth',
        'member_based_on',
        'select_member_ship',
        'member_ship_status',
        'member_ship_reg_date',
        'member_ship_fee_paid',
        'member_ship_fee_submission',
        'remarks'
    ];
}
