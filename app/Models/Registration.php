<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'event_id', 'num_tickets', 'status',
    ];

    /**
     * Una inscripción pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Una inscipción pertenece a un evento
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
