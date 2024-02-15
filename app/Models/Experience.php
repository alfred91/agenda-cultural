<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'start_date', 'date_text', 'short_description',
        'price_per_person', 'link', 'long_description', 'company_id', 'image',
    ];

    /**
     * Una experiencia pertenece a una única empresa
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
