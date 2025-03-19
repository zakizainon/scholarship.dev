<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicQualification extends Model
{
    protected $fillable = [
        'user_id',
        'spm_school',
        'spm_commencement_year',
        'spm_completion_year',
        'spm_result'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
