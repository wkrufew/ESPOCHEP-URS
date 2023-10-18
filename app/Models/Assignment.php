<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $guarded = ['id'];

    use HasFactory;

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    /* public function user()
    {
        return $this->belongsTo(User::class);
    } */

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class);
    }
}
