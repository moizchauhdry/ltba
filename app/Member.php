<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'mem_id', //UNIQUE
        'name',
        'father_name',
        'gender',
        'cnic_no', //UNIQUE
        'city',
        'contact_no', //UNIQUE
        'address',
        'date_of_birth',
        'membership_based_on',
        'select_member_ship',
        'member_ship_status',
        'member_ship_reg_date',
        'member_ship_fee_submission',
        'remarks'
    ];
}
