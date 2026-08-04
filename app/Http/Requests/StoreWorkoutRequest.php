<?php
// اسم الطالب: ____________ / رقم الطالب: ____________

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkoutRequest extends FormRequest
{
    /**
     * السماح بتنفيذ هذا الطلب (يمكن ربطه بنظام الصلاحيات لاحقاً)
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قواعد التحقق من صحة البيانات عند الإضافة
     */
    public function rules(): array
    {
        return [
            'name'              => 'required|string|max:255|unique:workouts,name',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'duration'          => 'required|integer|min:1',
            'sportstype_id'     => 'required|exists:sports_types,id',
            'workoutlevel_id'   => 'required|exists:workout_levels,id',
            'start_date'        => 'required|date|after:today',
            'image'             => 'nullable|image|max:2048', // 2MB
            'branches'          => 'nullable|array',
            'branches.*'        => 'exists:branches,id',
        ];
    }

    /**
     * رسائل خطأ مخصصة باللغة العربية
     */
    public function messages(): array
    {
        return [
            'name.required'             => 'اسم الحصة إجباري.',
            'name.unique'                => 'اسم الحصة موجود مسبقاً، يرجى اختيار اسم آخر.',
            'price.required'             => 'سعر الحصة إجباري.',
            'price.numeric'              => 'يجب أن يكون السعر رقماً.',
            'price.min'                  => 'لا يمكن أن يكون السعر بقيمة سالبة.',
            'duration.required'          => 'مدة الحصة إجبارية.',
            'duration.integer'           => 'يجب أن تكون المدة عدداً صحيحاً بالدقائق.',
            'duration.min'               => 'يجب أن تكون المدة أكبر من صفر.',
            'sports_type_id.required'    => 'يرجى اختيار التخصص الرياضي.',
            'sports_type_id.exists'      => 'التخصص الرياضي المختار غير صحيح.',
            'workout_level_id.required'  => 'يرجى اختيار مستوى الحصة.',
            'workout_level_id.exists'    => 'مستوى الحصة المختار غير صحيح.',
            'start_date.required'        => 'تاريخ بدء التسجيل إجباري.',
            'start_date.date'            => 'صيغة التاريخ غير صحيحة.',
            'start_date.after'           => 'يجب أن يكون تاريخ البدء في المستقبل.',
            'image.image'                => 'يجب أن يكون الملف صورة.',
            'image.max'                  => 'يجب ألا يتجاوز حجم الصورة 2 ميغابايت.',
        ];
    }
}
