<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    protected $guarded = ['id'];

    use HasFactory;

    //relacion de uno a mucho inversa
    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function workers()
    {
        return $this->hasMany(Worker::class, 'planning_id', 'id');
    }

    //relacion de uno a muchos
    /* public function assignments()
    {
        return $this->hasMany(Assignment::class);
    } */

    /* public function user(){
        return $this->belongsTo(User::class);
    } */

    /* public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function canton()
    {
        return $this->belongsTo(Canton::class);
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    } */
}
