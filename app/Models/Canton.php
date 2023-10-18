<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    protected $guarded = ['id'];
    
    use HasFactory;

    public function parishes(){
        return $this->hasMany(Parish::class);
    }

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }
}
