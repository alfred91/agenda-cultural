<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'date', 'time', 'description', 'city', 'address',
        'status', 'max_capacity', 'type', 'max_tickets_per_person',
        'category_id', 'image', 'user_id',
    ];

    /**
     *  Un evento pertenece a un creador.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un evento pertenece a una única categoría.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Un evento puede tener múltiples inscripciones.
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
