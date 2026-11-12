@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-purple-600">Create Category</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="/admin/categories" method="POST">
        @csrf

        <div class="mb-4">
            <label for="CJ_name" class="block text-gray-700 font-bold mb-2">Name</label>
            <input type="text" name="CJ_name" id="CJ_name" value="{{ old('CJ_name') }}" required
                   class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-purple-600">
            @error('CJ_name')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="CJ_description" class="block text-gray-700 font-bold mb-2">Description (optional)</label>
            <textarea name="CJ_description" id="CJ_description" rows="4"
                      class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-purple-600">{{ old('CJ_description') }}</textarea>
            @error('CJ_description')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="flex-1 bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 font-bold transition">
                Create Category
            </button>
            <a href="/admin/categories" class="flex-1 bg-gray-400 text-white py-3 rounded-lg hover:bg-gray-500 text-center font-bold transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
