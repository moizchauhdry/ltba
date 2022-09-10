<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElectionSeatCandidate extends Model
{
    protected $guarded = []; 

    public function member()
    {
        return $this->belongsTo(Member::class,'id','member_id');
    }
}
