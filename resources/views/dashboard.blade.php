@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Dashboard Overview</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Total Patients Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 hover:shadow-md transition">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Patients</dt>
                                <dd>
                                    <div class="text-3xl font-bold text-gray-900">{{ $totalPatients }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Doctors Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 hover:shadow-md transition">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-100 text-teal-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Doctors</dt>
                                <dd>
                                    <div class="text-3xl font-bold text-gray-900">{{ $totalDoctors }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Visits Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 hover:shadow-md transition">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-pink-100 text-pink-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Visits</dt>
                                <dd>
                                    <div class="text-3xl font-bold text-gray-900">{{ $totalVisits }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
