<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];

    public function electionSeatCandidate()
    {
        return $this->hasMany(ElectionSeatCandidate::class,'member_id','id');
    }
}
