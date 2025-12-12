@extends('layouts.admin')

@section('content')

<div class="min-h-screen p-10 bg-gradient-to-br from-blue-50 via-white to-purple-100">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-extrabold text-blue-900 drop-shadow">
            👤 Kelola Admin
        </h1>

        <a href="{{ route('admin.users.create') }}"
           class="px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold shadow
                  hover:bg-blue-700 hover:-translate-y-0.5 transition-all duration-200">
            + Tambah Admin
        </a>
    </div>

    @if(session('success'))
        <div class="mb-5 px-4 py-3 bg-green-200 text-green-800 rounded-xl shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white/90 backdrop-blur-xl border border-white/30 rounded-2xl shadow-xl p-6">

        @if($admins->isEmpty())
            <p class="text-gray-600">Belum ada admin yang terdaftar.</p>
        @else
            <table class="w-full">
                <thead>
                    <tr class="text-gray-600 text-sm uppercase tracking-wide border-b">
                        <th class="py-3 text-left">Nama</th>
                        <th class="py-3 text-left">Email</th>
                        <th class="py-3 text-left">Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                        <tr class="border-b border-gray-200 hover:bg-blue-50 transition-all">
                            <td class="py-3 font-semibold text-gray-800">
                                {{ $admin->name ?? $admin->nama }}
                            </td>
                            <td class="py-3 text-gray-700">
                                {{ $admin->email }}
                            </td>
                            <td class="py-3 text-gray-500 text-sm">
                                {{ $admin->created_at ? $admin->created_at->format('d M Y H:i') : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
</div>

@endsection
