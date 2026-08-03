<?php
// اسم الطالب: ____________ / رقم الطالب: ____________

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\SportsType;
use App\Models\WorkoutLevel;

class DashboardController extends Controller
{
    /**
     * عرض لوحة التحكم مع إحصائيات بسيطة
     */
    public function index()
    {
        $stats = [
            'workouts_count'       => Workout::count(),
            'sports_types_count'   => SportsType::count(),
            'workout_levels_count' => WorkoutLevel::count(),
            // عدد المدربين - يعتمد على وجود موديل Trainer مسبقاً
            'trainers_count'       => class_exists(\App\Models\Trainer::class)
                                        ? \App\Models\Trainer::count()
                                        : 0,
        ];

        return view('workouts.dashboard', compact('stats'));
    }
}
