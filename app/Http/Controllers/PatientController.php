<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Patient::query();

        // 1. Search by name or phone
        if ($request->has('search')) {
            $query->search($request->search);
        }

        // Enforce Doctor RBAC: doctors only view assigned patients
        if (auth()->check() && auth()->user()->role === 'doctor') {
            $query->where('doctor_id', auth()->id());
        }

        // 3. Pagination
        $patients = $query->paginate(15);
        
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::all();
        return view('patients.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:150',
            'gender' => 'required|string',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'doctor_id' => 'nullable|exists:doctors,id',
        ]);

        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $doctors = Doctor::all();
        return view('patients.edit', compact('patient', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:150',
            'gender' => 'required|string',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'doctor_id' => 'nullable|exists:doctors,id',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    /**
     * Remove the specified resource from storage (Soft Delete).
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient soft deleted successfully.');
    }

    /**
     * Display a listing of soft deleted resources.
     */
    public function trash()
    {
        $patients = Patient::onlyTrashed()->paginate(15);
        return view('patients.trash', compact('patients'));
    }

    /**
     * Restore the specified soft deleted resource.
     */
    public function restore($id)
    {
        $patient = Patient::onlyTrashed()->findOrFail($id);
        $patient->restore();

        return redirect()->route('patients.trash')->with('success', 'Patient restored successfully.');
    }

    /**
     * Permanently remove the specified resource from storage.
     * Admin only.
     */
    public function forceDelete($id)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Only Admins can permanently delete patients.');
        }

        $patient = Patient::withTrashed()->findOrFail($id);
        $patient->forceDelete();

        return redirect()->route('patients.trash')->with('success', 'Patient permanently deleted.');
    }
}
