<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /*protected $fillable = [
        'name',
        'contact_number',
        'address',
        'appointment_start',
        'appointment_end',
        'appointment_duration',
        'watermark_text',
        'watermark_image',
        'watermark_preference',
        'logo',
        'next_visit_followup_sms',
        'appointment_scheduled_sms',
        'appointment_updated_sms',
    ];*/
    protected $guarded = [];

    protected $casts = ['appointment_start' => 'datetime', 'appointment_end' => 'datetime'];
}
