@extends('layouts.app')

@section('title', 'Registrations - Event Planner')
@section('container-class', 'container mx-auto px-6 py-12')

@section('content')
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 flex items-center gap-3">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Event Registrations
        </h1>
        <p class="text-gray-500 mt-2">Manage all user registrations for events</p>
    </div>

    @if($registrations->count() > 0)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold text-white tracking-wide">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 10-6 0 3 3 0 006 0z"/></svg>
                                    User
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left font-semibold text-white tracking-wide">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Email
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left font-semibold text-white tracking-wide">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Event
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left font-semibold text-white tracking-wide">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Registration Date
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($registrations as $registration)
                            <tr class="odd:bg-white even:bg-gray-50 hover:bg-purple-50 transition duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 10-6 0 3 3 0 006 0z"/></svg>
                                        <span class="font-medium text-gray-900">{{ $registration->user->CJ_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <a href="mailto:{{ $registration->user->CJ_email }}" class="hover:text-purple-600 transition">{{ $registration->user->CJ_email }}</a>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-2 bg-purple-100 text-purple-800 px-3 py-1 rounded-full font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $registration->event->CJ_title }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $registration->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    
    @else
        <div class="bg-white rounded-lg shadow-lg p-12 text-center border border-gray-200">
            <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <p class="text-gray-600 text-lg font-semibold">No registrations found</p>
            <p class="text-gray-500 text-sm mt-2">Users will appear here when they register for events</p>
        </div>
    @endif
@endsection

@section('footer')
    <footer class="bg-indigo-950 text-white py-12 mt-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-8">
                <h3 class="text-3xl font-bold mb-4">Event <span class="text-purple-400">Planner</span></h3>
                <div class="flex justify-center gap-8 mb-6">
                    <a href="{{ route('events.index') }}" class="hover:text-purple-400 transition">Home</a>
                    <a href="{{ route('admin.events.index') }}" class="hover:text-purple-400 transition">Admin Events</a>
                    <a href="{{ route('registrations.index') }}" class="hover:text-purple-400 transition">Registrations</a>
                </div>
            </div>
            <div class="text-center text-sm text-gray-400 border-t border-gray-700 pt-6">
                <p>&copy; {{ date('Y') }} Event Planner</p>
            </div>
        </div>
    </footer>
@endsection
