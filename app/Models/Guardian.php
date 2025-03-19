<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'guardiantype',
        'guardian_name',
        'guardian_mykad',
        'guardian_nationality',
        'guardian_othernationality',
        'guardian_status',
        'guardian_address',
        'guardian_postcode',
        'guardian_city',
        'guardian_state',
        'guardian_country',
        'guardian_mobilephone',
        'guardian_housephone',
        'guardian_email',
        'guardian_pnbstaff',
        'guardian_statusemployment',
        'guardian_employername',
        'guardian_employeraddress',
        'guardian_officephone',
        'guardian_position',
        'guardian_salary',
        'guardian_otherincome',
        'guardian_previousemployer',
        'guardian_lastposition',
        'guardian_lastsalary',
        'guardian_pension',
        'guardian_postretirement',
        'guardian_retireemployername',
        'guardian_retireemployeraddress',
        'guardian_retireofficephone',
        'guardian_retiresalary'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
