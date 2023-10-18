<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $guarded = ['id'];
    
    use HasFactory;

    /* public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    } */

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certificado()
    {
        return $this->belongsTo(Certificado::class);
    }

    public function sticker()
    {
        return $this->belongsTo(Sticker::class);
    }
}
