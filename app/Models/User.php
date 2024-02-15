<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dni', 'name', 'surname', 'age', 'email', 'password',
        'address', 'city', 'phone', 'role', 'company_id', 'position',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relaciones

    /**
     * Eventos creados por el usuario creador_eventos.
     */
    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    /**
     * El usuario creador_eventos pertenece a una empresa.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Inscripciones del usuario a eventos (si es un asistente).
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'attendee_id');
    }

    // ROLES

    /**
     * Determina si el usuario es un asistente.
     *
     * @return bool
     */
    public function isAttendee()
    {
        return $this->role === 'asistente';
    }

    /**
     * Determina si el usuario es creador de eventos.
     *
     * @return bool
     */
    public function isEventCreator()
    {
        return $this->role === 'creador_eventos';
    }

    /**
     * Determina si el usuario es el Admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'administrador';
    }
}
