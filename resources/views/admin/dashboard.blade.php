@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 p-6">
    <!-- Card 1 -->
    <div class="bg-blue-400 text-white p-10 rounded-lg shadow-lg flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold">Users</h2>
            <p class="text-3xl font-bold">10</p>
            <p class="text-sm">More Info</p>
        </div>
        <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
        </svg>
    </div>

    <!-- Card 2 -->
    <div class="bg-teal-400 text-white p-6 rounded-lg shadow-lg flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold">Jurusan</h2>
            <p class="text-3xl font-bold">7</p>
            <p class="text-sm">More Info</p>
        </div>
        <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
        </svg>
    </div>

    <!-- Card 3 -->
    <div class="bg-orange-400 text-white p-6 rounded-lg shadow-lg flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold">Widget Received</h2>
            <p class="text-3xl font-bold">486</p>
            <p class="text-sm">Completed Orders</p>
        </div>
        <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8.3-3.59 8-8-3.59-8-8-8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
        </svg>
    </div>

    <!-- Card 4 -->
    <div class="bg-red-400 text-white p-6 rounded-lg shadow-lg flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold">Widget Received</h2>
            <p class="text-3xl font-bold">486</p>
            <p class="text-sm">Completed Orders</p>
        </div>
        <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8.3-3.59 8-8-3.59-8-8-8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
        </svg>
    </div>
</div>
@endsection