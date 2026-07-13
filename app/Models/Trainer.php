<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Trainer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['firstname',
        'lastname',
        'fathername',
        'phone',
        'address',
        'image',
        'gender',
        'sports_type_id',
        'birthplace',
        'birthdate',
        'years_of_experience',
        'SSN',
        'email',
        'hiring_date',
        'certification',
        'trainer_status_id'];

    protected $hidden = ['remember_token'];

    protected $casts = [
        'birthdate' => 'date',
        'hiring_date' => 'date',
        'email_verified_at' => 'datetime',
        'years_of_experience' => 'integer',
    ];

    public function sportsType()
    {
        return $this->belongsTo(SportsType::class);
    }

    public function trainerStatus()
    {
        return $this->belongsTo(TrainerStatus::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['specialty'] ?? null, function ($query, $specialty) {
            $query->where('sports_type_id', $specialty);
        })->when($filters['experience'] ?? null, function ($query, $experience) {
            $query->where('years_of_experience', '>=', $experience);
        })->when($filters['status'] ?? null, function ($query, $status) {
            $query->where('trainer_status_id', $status);
        });
    }
    protected function profilePictureUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image
                ? Storage::disk('public')->url($this->image)
                : asset('images/avatar-default.jpg')
        );
    }
}
