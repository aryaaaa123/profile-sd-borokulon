<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    private array $roles = ['guru','tendik'];

    public function index()
    {
        $items = Staff::orderBy('name')->paginate(20);
        return view('admin.staff.index', compact('items'));
    }

    public function create()
    {
        $roles = $this->roles;
        return view('admin.staff.create', compact('roles'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name'     => ['required','string','max:120'],
            'role'     => ['required', Rule::in($this->roles)],
            'subject'  => ['nullable','string','max:100'],
            'position' => ['nullable','string','max:100'],
            'photo'    => ['nullable','image','max:2048'],
        ]);

        if ($r->hasFile('photo')) {
            $data['photo'] = $r->file('photo')->store('staff', 'public');
        }

        Staff::create($data);
        return redirect()->route('admin.staff.index')->with('success','Data ditambahkan.');
    }

    public function edit(Staff $staff)
    {
        $roles = $this->roles;
        return view('admin.staff.edit', compact('staff','roles'));
    }

    public function update(Request $r, Staff $staff)
    {
        $data = $r->validate([
            'name'     => ['required','string','max:120'],
            'role'     => ['required', Rule::in($this->roles)],
            'subject'  => ['nullable','string','max:100'],
            'position' => ['nullable','string','max:100'],
            'photo'    => ['nullable','image','max:2048'],
        ]);

        if ($r->hasFile('photo')) {
            if ($staff->photo) Storage::disk('public')->delete($staff->photo);
            $data['photo'] = $r->file('photo')->store('staff', 'public');
        }

        $staff->update($data);
        return back()->with('success','Data diperbarui.');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->photo) Storage::disk('public')->delete($staff->photo);
        $staff->delete();
        return back()->with('success','Data dihapus.');
    }
}
