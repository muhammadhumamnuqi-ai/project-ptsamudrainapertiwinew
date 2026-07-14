@extends('layouts.app')

@section('page_title', 'Edit Pengguna')
@section('page_subtitle', 'Perbarui informasi akun, role, dan status pengguna')

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

        <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-slate-100">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-700 flex items-center justify-center text-white text-lg font-bold">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div>
                <h3 class="font-bold text-slate-900">{{ $user->name }}</h3>
                <p class="text-xs text-slate-500">{{ $user->email }} • Bergabung {{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" required value="{{ old('name', $user->name) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" required value="{{ old('email', $user->email) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Password Baru <span class="text-slate-400 font-normal">(kosongkan jika tidak diganti)</span></label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Role Pengguna</label>
                    <select name="role" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                        <option value="abk" {{ $user->role==='abk'?'selected':'' }}>Calon ABK</option>
                        <option value="operator" {{ $user->role==='operator'?'selected':'' }}>Operator</option>
                        <option value="super_admin" {{ $user->role==='super_admin'?'selected':'' }}>Super Admin</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Status Akun</label>
                    <select name="status_akun" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500">
                        <option value="aktif" {{ $user->status_akun==='aktif'?'selected':'' }}>Aktif</option>
                        <option value="nonaktif" {{ $user->status_akun==='nonaktif'?'selected':'' }}>Non-Aktif</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center space-x-3 pt-4 border-t border-slate-100">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-xl text-sm shadow-lg shadow-blue-600/25 transition">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>Simpan Perubahan
                </button>
                <a href="{{ route('admin.users') }}" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
