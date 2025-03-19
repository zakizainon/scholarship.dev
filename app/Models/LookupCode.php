<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LookupCode extends Model
{
    protected $fillable = [
        'id',
        'code_codegroup',
        'codevalue',
        'c_engdesc',
        'c_bmdesc',
        'scholarship01',
        'scholarship02',
        'scholarship03',
        'scholarship04',
        'scholarship05',
        'scholarship06',
        'scholarship07',
        'scholarship08',
        'orderval',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(CodeGroup::class, 'code_codegroup', 'codegroup');
    }
}