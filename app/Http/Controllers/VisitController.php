<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Patient;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * List all visits for a specific patient.
     */
    public function index($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        
        // Enforce Doctor RBAC: if user is a doctor, ensure the patient is assigned to them
        if (auth()->check() && auth()->user()->role === 'doctor') {
            if ($patient->doctor_id !== auth()->id()) {
                abort(403, 'Unauthorized action. This patient is not assigned to you.');
            }
        }

        // Fetch visits associated with the patient, load doctor info, sort by newest
        $visits = $patient->visits()->with('doctor')->orderBy('visit_date', 'desc')->get();

        return response()->json([
            'patient' => $patient->name,
            'visits' => $visits
        ]);
    }

    /**
     * Store a newly created visit.
     */
    public function store(Request $request)
    {
        // Validation ensures visit is linked to a valid patient and doctor, with proper date/notes.
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'visit_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // If the user is a doctor, automatically link the visit to their ID for security,
        // and ensure the patient they are logging a visit for is assigned to them.
        if (auth()->check() && auth()->user()->role === 'doctor') {
            $patient = Patient::findOrFail($validated['patient_id']);
            if ($patient->doctor_id !== auth()->id()) {
                abort(403, 'Unauthorized action. This patient is not assigned to you.');
            }
            $validated['doctor_id'] = auth()->id();
        }

        $visit = Visit::create($validated);

        return response()->json([
            'message' => 'Visit created successfully.',
            'visit' => $visit
        ], 201);
    }
}
