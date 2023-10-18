<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    protected $guarded = ['id'];
    
    use HasFactory;

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }
}
