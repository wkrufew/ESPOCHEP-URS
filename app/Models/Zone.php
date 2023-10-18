<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $guarded = ['id'];
    
    use HasFactory;

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    public function sectors()
    {
        return $this->hasMany(Sector::class);
    }
}
