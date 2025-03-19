<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipManagement extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'scholarship_management';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'code',
        'name',
        'startdate',
        'enddate',
        'maxage',
        'status',
        'internalflag',
        'personal',
        'parentdetails',
        'academics',
        'spmresults',
        'skills',
        'experience',
        'study',
        'document',
        'declaration',
        'consent',
        'recordstatus',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'uuid' => 'string',
    //     'code' => 'string',
    //     'name' => 'string',
    //     'startdate' => 'date',
    //     'enddate' => 'date',
    //     'status' => 'string',
    //     'internalflag' => 'boolean',
    //     'personal' => 'json',
    //     'parentdetails' => 'json',
    //     'academics' => 'json',
    //     'spmresults' => 'json',
    //     'skills' => 'json',
    //     'experience' => 'json',
    //     'study' => 'json',
    //     'document' => 'json',
    //     'declaration' => 'json',
    //     'consent' => 'json',
    //     'recordstatus' => 'string',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
