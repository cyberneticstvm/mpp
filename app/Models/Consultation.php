<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function status()
    {
        return ($this->deleted_at == NULL) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deleted</span>';
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id', 'patient_id');
    }
}
