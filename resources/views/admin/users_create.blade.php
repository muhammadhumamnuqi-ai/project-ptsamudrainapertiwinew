@extends('layouts.app')

@section('page_title', 'Tambah Pengguna Baru')
@section('page_subtitle', 'Buat akun operator, calon ABK, atau administrator sistem')

@section('page_actions')
<a href="{{ route('admin.users') }}" class="inline-flex items-center text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
</a>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-xs space-y-1">
            <p class="font-bold"><i class="fa-solid fa-triangle-exclamation mr-1.5"></i>Terjadi kesalahan:</p>
            <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" required value="{{ old('name') }}" placeholder="Ahmad Budi" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}" placeholder="email@domain.com" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Password</label>
                    <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Role Pengguna</label>
                    <select name="role" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                        <option value="abk" {{ old('role')==='abk'?'selected':'' }}>Calon ABK</option>
                        <option value="operator" {{ old('role')==='operator'?'selected':'' }}>Operator</option>
                        <option value="super_admin" {{ old('role')==='super_admin'?'selected':'' }}>Super Admin</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Status Akun</label>
                    <select name="status_akun" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Non-Aktif</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center space-x-3 pt-4 border-t border-slate-100">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-xl text-sm shadow-lg shadow-blue-600/25 transition">
                    <i class="fa-solid fa-user-plus mr-2"></i>Tambahkan Pengguna
                </button>
                <a href="{{ route('admin.users') }}" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
