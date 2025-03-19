<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CodeGroup extends Model
{
    protected $fillable = [
        'id',
        'codegroup',
        'c_engdesc',
        'status'
    ];

    public function lookupcode()
    {
        return $this->hasMany(LookupCOode::class, 'code_codegroup', 'codegroup');
    }
}