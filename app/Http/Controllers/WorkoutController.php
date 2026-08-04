<?php
// اسم الطالب: ____________ / رقم الطالب: ____________

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use App\Models\Workout;
use App\Models\SportsType;
use App\Models\WorkoutLevel;
use App\Models\Warehouse;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkoutController extends Controller
{
    /**
     * عرض جميع الحصص (Grid View مع Pagination)
     */
    public function index()
    {
        $workouts = Workout::with(['sportsType', 'workoutLevel'])
            ->latest()
            ->paginate(9);

        return view('workouts.workouts.index', compact('workouts'));
    }

    /**
     * عرض نموذج إضافة حصة جديدة
     */
    public function create()
    {
        $sportsTypes   = SportsType::orderBy('type')->get();
        $workoutLevels = WorkoutLevel::orderBy('level')->get();
        $branches      = Branch::orderBy('name')->get();
        $warehouses    = Warehouse::orderBy('name')->get();

        return view('workouts.workouts.create', compact('sportsTypes', 'workoutLevels', 'branches', 'warehouses'));
    }

    /**
     * حفظ حصة جديدة في قاعدة البيانات
     */
    public function store(StoreWorkoutRequest $request)
    {
        $validated = $request->validated();

        // رفع الصورة إن وجدت
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('workouts', 'public');
        }

        $workout = Workout::create($validated);

        // ربط الحصة بالفروع المختارة (إن وجدت)
        if (!empty($validated['branches'])) {
            $workout->branches()->sync($validated['branches']);
        }

        return redirect()->route('workouts.index')
                          ->with('success', 'تم إضافة الحصة بنجاح.');
    }

    /**
     * عرض تفصيلي لحصة محددة
     * يعرض الأعضاء المسجلين، المدربين المرتبطين، والفروع المتاحة
     */
    public function show(Workout $workout)
    {
        $workout->load(['sportsType', 'workoutLevel', 'branches', 'trainers', 'members', 'warehouses']);

        return view('workouts.workouts.show', compact('workout'));
    }

    /**
     * عرض نموذج تعديل حصة موجودة
     */
    public function edit(Workout $workout)
    {
        $sportsTypes   = SportsType::orderBy('type')->get();
        $workoutLevels = WorkoutLevel::orderBy('level')->get();
        $branches      = Branch::orderBy('name')->get();
        $warehouses    = Warehouse::orderBy('name')->get();
        // معرفات الفروع المرتبطة حالياً بالحصة (لتحديدها في النموذج)
        $selectedBranches = $workout->branches->pluck('id')->toArray();
        $selectedWarehouses = $workout->warehouses->pluck('id')->toArray();

        return view('workouts.workouts.edit', compact('workout', 'sportsTypes', 'workoutLevels', 'branches', 'warehouses', 'selectedBranches', 'selectedWarehouses'));
    }

    /**
     * تحديث بيانات حصة موجودة
     */
    public function update(UpdateWorkoutRequest $request, Workout $workout)
    {
        $validated = $request->validated();

        // استبدال الصورة القديمة بجديدة إن تم رفعها
        if ($request->hasFile('image')) {
            if ($workout->image) {
                Storage::disk('public')->delete($workout->image);
            }
            $validated['image'] = $request->file('image')->store('workouts', 'public');
        }

        $workout->update($validated);

        // تحديث ربط الفروع
        $workout->branches()->sync($validated['branches'] ?? []);

        // تحديث ربط المستودعات
        $workout->warehouses()->sync($validated['warehouses'] ?? []);

        return redirect()->route('workouts.show', $workout)
                          ->with('success', 'تم تحديث بيانات الحصة بنجاح.');
    }

    /**
     * حذف حصة
     * شرط: عدم ارتباطها بفرع أو مدرب (حسب متطلبات الوظيفة)
     */
    public function destroy(Workout $workout)
    {
        if ($workout->branches()->exists() || $workout->trainers()->exists()) {
            return back()->with(
                'error',
                'لا يمكن حذف الحصة لارتباطها بفرع أو مدرب. يرجى إزالة الارتباطات أولاً.'
            );
        }

        if ($workout->image) {
            Storage::disk('public')->delete($workout->image);
        }

        $workout->delete();

        return redirect()->route('workouts.index')
                          ->with('success', 'تم حذف الحصة بنجاح.');
    }

    /**
     * صفحة البحث المتقدم (تعرض الواجهة فقط)
     */
    public function searchPage()
    {
        $sportsTypes   = SportsType::orderBy('type')->get();
        $workoutLevels = WorkoutLevel::orderBy('level')->get();

        return view('workouts.workouts.search', compact('sportsTypes', 'workoutLevels'));
    }

    /**
     * البحث المتقدم عبر Ajax - يعيد نتائج بصيغة JSON
     * الفلاتر: التخصص الرياضي، المستوى، السعر
     */
    public function search(Request $request)
    {
        $workouts = Workout::with(['sportsType', 'workoutLevel'])
            ->filter([
                'sports_type_id'   => $request->input('sports_type_id'),
                'workout_level_id' => $request->input('workout_level_id'),
                'max_price'        => $request->input('max_price'),
            ])
            ->latest()
            ->get();

        // بناء HTML للبطاقات لإرجاعه إلى الواجهة (اختياري) أو إرجاع JSON خام
        $html = view('workouts.workouts.partials.grid', compact('workouts'))->render();

        return response()->json([
            'status'  => 'success',
            'count'   => $workouts->count(),
            'html'    => $html,
        ]);
    }
}
