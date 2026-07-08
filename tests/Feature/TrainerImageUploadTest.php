<?php

use App\Models\SportsType;
use App\Models\Trainer;
use App\Models\TrainerStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('trainer profile image can be uploaded when creating a trainer', function () {
    Storage::fake('public');

    $sportsType = SportsType::create(['type' => 'Swimming']);
    $trainerStatus = TrainerStatus::create(['status' => 'Active']);

    $response = $this->post(route('trainers.store'), [
        'firstname' => 'Maya',
        'lastname' => 'Stone',
        'fathername' => 'Sam',
        'SSN' => '12345678901',
        'phone' => '0912345678',
        'address' => '12 Test Street',
        'email' => 'maya@example.com',
        'gender' => 'Female',
        'birthplace' => 'Riyadh',
        'birthdate' => now()->subYears(30)->format('Y-m-d'),
        'years_of_experience' => 5,
        'hiring_date' => now()->subYear()->format('Y-m-d'),
        'image' => UploadedFile::fake()->image('profile.jpg')->size(128),
        'sports_type_id' => $sportsType->id,
        'trainer_status_id' => $trainerStatus->id,
        'certification' => 'level_2',
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('trainers.index'));

    $this->assertDatabaseHas('trainers', [
        'firstname' => 'Maya',
        'address' => '12 Test Street',
        'birthplace' => 'Riyadh',
    ]);

    $imagePath = Trainer::where('email', 'maya@example.com')->value('image');

    expect($imagePath)->toStartWith('trainers/');
    Storage::disk('public')->assertExists($imagePath);
});
