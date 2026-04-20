<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Store a newly created report.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'report_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // Max 5MB
        ]);

        // Enforce Doctor RBAC: if user is a doctor, ensure the patient is assigned to them
        if (auth()->check() && auth()->user()->role === 'doctor') {
            $patient = \App\Models\Patient::findOrFail($validated['patient_id']);
            if ($patient->doctor_id !== auth()->id()) {
                abort(403, 'Unauthorized action. This patient is not assigned to you.');
            }
        }

        // Store the file in the public disk, under the 'reports' directory
        $path = $request->file('report_file')->store('reports', 'public');

        // Create the database record linking to the patient
        $report = Report::create([
            'patient_id' => $validated['patient_id'],
            'file_path' => $path,
        ]);

        return response()->json([
            'message' => 'Report uploaded successfully.',
            'report' => $report,
            'file_url' => Storage::disk('public')->url($path)
        ], 201);
    }
}
