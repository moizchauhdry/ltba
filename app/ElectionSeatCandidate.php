<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElectionSeatCandidate extends Model
{
    protected $guarded = []; 

    public function member()
    {
        return $this->belongsTo(Member::class,'member_id','id');
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class,'seat_id','id');
    }

    public function election()
    {
        return $this->belongsTo(Election::class,'election_id','id');
    }

}
