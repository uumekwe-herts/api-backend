<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CaseAttachment extends Model
{
    protected $table = 'case_attachments';

    public $timestamps = true;
    protected $fillable = ['case_id', 'user', 'file_name', 'file_path'];

}
