<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $guarded = ['id'];
    
    use HasFactory;

    //Relacion uno a muchos
    public function cantons(){
        return $this->hasMany(Canton::class);
    }
    
    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }
}
