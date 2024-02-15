<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'address', 'phone', 'email', 'website', 'extra_info',
    ];

    /**
     * Cada empresa ofrece múltiples experiencias y estas pertenecen a una única empresa.
     */
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
}
