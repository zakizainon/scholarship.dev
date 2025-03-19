<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'mykad',
        'email',
        'password',
        'role',
        'secret_question',
        'secret_answer',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Eloquent relationship for Applications table
    public function application()
    {
        return $this->hasOne(Application::class, 'user_id', 'id');
    }

    // Eloquent relationship for Guardians table
    public function guardian()
    {
        return $this->hasMany(Guardian::class, 'user_id', 'id');
    }

    // Eloquent relationship for Academic_Qualifications Application table
    public function academic_qualification()
    {
        return $this->hasOne(AcademicQualification::class, 'user_id', 'id');
    }

    // Eloquent relationship for Documents table
    public function document()
    {
        return $this->hasMany(Document::class, 'user_id', 'id');
    }
}
