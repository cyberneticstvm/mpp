<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = ['review_date' => 'datetime'];

    public function status()
    {
        return ($this->deleted_at == NULL) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deleted</span>';
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function symptoms()
    {
        return $this->hasMany(PatientSymptom::class, 'consultation_id', 'id');
    }

    public function diagnoses()
    {
        return $this->hasMany(PatientDiagnosis::class, 'consultation_id', 'id');
    }

    public function tests()
    {
        return $this->hasMany(PatientTest::class, 'consultation_id', 'id');
    }

    public function medicines()
    {
        return $this->hasMany(PatientMedicine::class, 'consultation_id', 'id');
    }
}
