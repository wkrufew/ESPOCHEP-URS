<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';
    protected $guarded = ['id'];
    
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function certificados()
    {
        return $this->hasMany(Certificado::class);
    }

    public function stickers()
    {
        return $this->hasMany(Sticker::class);
    }

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }

    public function campoUser()
    {
        return $this->hasOne(User::class, 'equipment_id')->where('role', 'campo');
    }
}
