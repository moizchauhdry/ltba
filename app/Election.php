<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $fillable = ['name','start_date','end_date','election_end_checkbox','status'];




    
}
