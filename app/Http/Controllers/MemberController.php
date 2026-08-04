<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipType;
use App\Models\MemberStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    // دالة العرض مع الفلترة الدقيقة
    public function index(Request $request)
{
    // جلب الحالات لعرضها في الفورم
    $statuses = \App\Models\MemberStatus::all();
    
    $query = Member::query();

    // الفلترة الحالية
    $query->when($request->first_name, fn($q) => $q->where('first_name', $request->first_name));
    $query->when($request->last_name, fn($q) => $q->where('last_name', $request->last_name));
    $query->when($request->national_id, fn($q) => $q->where('national_id', $request->national_id));
    
    // إضافة فلترة الحالة الجديدة
    $query->when($request->member_status_id, fn($q) => $q->where('member_status_id', $request->member_status_id));

    $members = $query->with(['membershipType', 'memberStatus'])->get();

    return view('members.index', compact('members', 'statuses'));
}    public function create()
    {
        $types = MembershipType::all();
        $statuses = MemberStatus::all(); 
        return view('members.create', compact('types', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'birth_date' => [
            'required', 
            'date', 
            'before_or_equal:' . date('Y-m-d', strtotime('-18 years')),
            'after_or_equal:' . date('Y-m-d', strtotime('-70 years'))
        ],
            'national_id' => 'required|digits:11|unique:members,national_id',
            'phone' => ['required', 'regex:/^09\d{8}$/'],
            'membership_type_id' => 'required|exists:membership_types,id',
            'membership_duration' => 'required|integer',
        ]);

        $imagePath = $request->hasFile('photo') ? $request->file('photo')->store('members', 'public') : null;
        $active_status = MemberStatus::where('status', 'Active')->first();
        Member::create([
            'first_name' => $request->first_name,
            'father_name' => $request->father_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'national_id' => $request->national_id,
            'phone' => $request->phone,
            'membership_type_id' => $request->membership_type_id,
            'membership_duration' => $request->membership_duration,
            'photo' => $imagePath,
            'membership_end_date' => null,
            'member_status_id' => $active_status->id
        ]);

        return redirect('/members')->with('success', 'Member added successfully!');
    }

    public function edit($id)
{
    $member = Member::findOrFail($id);
    $types = MembershipType::all();
    $statuses = MemberStatus::all(); // أضف هذا السطر
    return view('members.edit', compact('member', 'types', 'statuses'));
}

    public function update(Request $request, $id)
{
    $member = Member::findOrFail($id);
    
    $request->validate([
        'first_name' => 'required',
        'father_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:members,email,'.$id,
        'national_id' => 'required|digits:11|unique:members,national_id,'.$id,
        'member_status_id' => 'required|exists:member_statuses,id', // تحقق من وجود الحالة
    ]);

    $data = $request->except('photo');
    
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('members', 'public');
    }
    
    $member->update($data);
    
    return redirect('/members')->with('success', 'Member updated successfully!');
}
public function destroy($id)
{
    // البحث عن العضو
    $member = Member::findOrFail($id);
    
    // حذف الصورة من التخزين إذا كانت موجودة
    if ($member->photo) {
        \Storage::disk('public')->delete($member->photo);
    }
    
    // حذف السجل من قاعدة البيانات
    $member->delete();
    
    // العودة مع رسالة نجاح
    return redirect('/members')->with('success', 'Member deleted successfully!');
}
public function show($id)
{
    // جلب العضو مع بيانات نوع الاشتراك المرتبط به
    $member = Member::with('membershipType')->findOrFail($id);
    
    return view('members.show', compact('member'));
}
}