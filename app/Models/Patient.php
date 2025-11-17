<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'dni',
        'phone',
        'email',
        'birth_date',
        'address',
        'is_active',
    ];

    protected $table = 'patients';

    protected $casts = [
        'birth_date' => 'date',
        'is_active' => 'boolean',
    ];
}