<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'age',
        'race',
        'other_race',
        'nationality',
        'birthstate',
        'other_birthstate',
        'gender',
        'maritalstatus',
        'housephone',
        'mobilephone',
        'permanentaddress',
        'permanentcity',
        'permanentpostcode',
        'permanentstate',
        'other_permanentstate',//new additional field
        'permanentcountry',//new additional field
        'emergencyname',
        'relationship',
        'other_relationship',
        'emergencyphone',
        'emergencyaddress',
        'emergencycity',
        'emergencypostcode',
        'emergencystate',
        'other_emergencystate',//new additional field
        'emergencycountry',//new additional field
        'parentname', //new additional field
        'parentrelationship', //new additional field
        'parentoccupation', //new additional field
        'parentphone', //new additional field
        'parentaddress', //new additional field
        'parentstaffid', //new additional field
        'studylevel', //new additional field
        'coursename',
        'universityname',
        'universitycountry',
        'commencementyear',
        'completionyear',
        'result',
        'resultother',
        'studyextension',
        'reasonextension',
        'spmresults', //new additional field
        'spmyear',//new additional field
        'personalstatement',
        'skillsandextracurricular',
        'activityextra',//new additional field
        'employmentstatus',
        // 'employertype',
        'employername',
        'employeraddress',
        'officephone',
        'position',
        'salary',
        'appliedlevelstudy',
        'majorstudy',
        'appliedcoursetitle',
        'university',
        'studymode',
        'startdate',
        'enddate',
        'studyperiod',
        'researchproposalsummary',
        'cgpasemresult',
        'othersemresult',
        'declaration01',
        'declaration02',
        'declaration03',
        'declaration04',
        'declaration05',
        'declaration06',
        'declaration07',
        'declaration08',
        'declaration09',
        'consent01',
        'consent02',
        'consent03',
        'tab01',
        'tab02',
        'tab03',
        'tab04',
        'tab05',
        'tab06',
        'tab07',
        'tab08',
        'tab09',
        'tab10',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scholarshipmanagement()
    {
        return $this->belongsTo(ScholarshipManagement::class, 'id', 'status', 'name');
    }
    
}
