<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = ['dob' => 'datetime', 'appointment_date' => 'datetime', 'appointment_time' => 'datetime'];

    public function status()
    {
        return ($this->deleted_at == NULL) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deleted</span>';
    }
}
