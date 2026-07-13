<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Member;

class MemberController extends Controller
{
    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'father_name' => 'required',
            'last_name' => 'required',
            'national_id' => 'required|unique:gym_members,national_id',
            'phone' => 'required|unique:gym_members,phone',
            'membership_type' => 'required',
            'membership_duration' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // معالجة الصورة بشكل نظيف
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('members', 'public');
        }

        // DB::table('gym_members')->insert([
        //     'first_name' => $request->first_name,
        //     'father_name' => $request->father_name,
        //     'last_name' => $request->last_name,
        //     'national_id' => $request->national_id,
        //     'phone' => $request->phone,
        //     'membership_type' => $request->membership_type,
        //     'membership_duration' => $request->membership_duration,
        //     'image' => $imagePath, // سيتم إرسال null إذا لم توجد صورة
        //     'membership_start_date' => now(),
        //     'status' => 'Active',
        //     'email' => 'N/A',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        Member::create([
            'first_name' => $request->first_name,
            'father_name' => $request->father_name,
            'last_name' => $request->last_name,
            'national_id' => $request->national_id,
            'phone' => $request->phone,
            'membership_type' => $request->membership_type,
            'membership_duration' => $request->membership_duration,
            'image' => $imagePath, // سيتم إرسال null إذا لم توجد صورة
            'membership_start_date' => now(),
            'status' => 'Active',
            'email' => 'N/A',
        ]);


        return redirect('/members')->with('success', 'Member added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'father_name' => 'required',
            'last_name' => 'required',
            'national_id' => 'required|unique:gym_members,national_id,' . $id,
            'phone' => 'required|unique:gym_members,phone,' . $id,
            'membership_duration' => 'required|integer',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'first_name' => $request->first_name,
            'father_name' => $request->father_name,
            'last_name' => $request->last_name,
            'national_id' => $request->national_id,
            'phone' => $request->phone,
            'membership_type' => $request->membership_type,
            'membership_duration' => $request->membership_duration,
            'status' => $request->status,
            'updated_at' => now(),
        ];

        // تحديث الصورة فقط إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('members', 'public');
            $data['image'] = $imagePath;
        }

        // DB::table('gym_members')->where('id', $id)->update($data);
        Member::where('id', $id)->update($data);

        return redirect('/members')->with('success', 'Member information updated successfully!');
    }

    // بقية الدوال (index, edit, destroy) تبقى كما هي بدون تغيير
    public function index(Request $request)
    {
        // $query = DB::table('gym_members');
        $query = Member::query();
        if ($request->filled('first_name')) $query->where('first_name', 'LIKE', $request->first_name . '%');
        if ($request->filled('last_name')) $query->where('last_name', 'LIKE', $request->last_name . '%');
        if ($request->filled('national_id')) $query->where('national_id', $request->national_id);
        if ($request->filled('membership_type')) $query->where('membership_type', $request->membership_type);
        if ($request->filled('created_at')) $query->whereDate('created_at', $request->created_at);
        $members = $query->get();
        return view('members.index', compact('members'));
    }

    public function edit($id)
    {
        $member = Member::where('id', $id)->first();
        return view('members.edit', compact('member'));
    }

    public function destroy($id)
    {
        Member::where('id', $id)->delete();
        return redirect('/members')->with('success', 'Member deleted successfully!');
    }
}
