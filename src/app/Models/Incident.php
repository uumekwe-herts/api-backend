<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $table = 'cases';
    public $timestamps = true;

    protected $fillable = ['user_id','reporter_type', 'reporting_for', 'contact_phone',
        'contact_email','category','age', 'contact_first_name', 'contact_last_name','case_details',
    'incident_address', 'number_of_victims', 'number_of_violators', 'date_of_incident'
    ];

    public function attachments()
    {
        return $this->hasMany(CaseAttachment::class, 'case_id');
    }

    public function comments()
    {
        return $this->hasMany(IncidentComment::class, 'case_id');
    }
}
