@extends('layouts.app')

@section('page_title', 'Log Aktivitas Sistem')
@section('page_subtitle', 'Rekam jejak audit trail (Audit Log) seluruh aktivitas pengguna dalam sistem')

@section('page_actions')
<a href="{{ route('dashboard.admin') }}" class="inline-flex items-center text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
</a>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    
    {{-- Filters --}}
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-end justify-between gap-4 bg-slate-50/50">
        <form method="GET" action="{{ route('admin.logs') }}" class="flex flex-col md:flex-row items-end gap-3 w-full md:w-auto">
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full md:w-auto bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full md:w-auto bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Pencarian</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aktivitas atau nama..." class="w-full md:w-auto bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-bold px-4 py-2 rounded-xl text-xs shadow-lg transition">Filter</button>
            @if(request()->hasAny(['start_date','end_date','search']))
                <a href="{{ route('admin.logs') }}" class="text-xs font-semibold text-red-600 hover:underline px-2 py-2">Reset</a>
            @endif
        </form>
    </div>

    {{-- Log List --}}
    <div class="divide-y divide-slate-100">
        @forelse($logs as $log)
        <div class="p-5 hover:bg-slate-50 transition flex items-start space-x-4">
            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 flex-shrink-0 mt-0.5">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm text-slate-800 leading-relaxed">
                    <strong class="font-bold text-slate-900">{{ $log->user ? $log->user->name : 'Sistem' }}</strong> 
                    <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wide bg-slate-200 text-slate-600 ml-1 mr-1">
                        {{ $log->user ? $log->user->role : 'Sistem' }}
                    </span>
                    — {{ $log->aktivitas }}
                </p>
                <div class="mt-1 flex items-center text-xs text-slate-500 space-x-4">
                    <span><i class="fa-regular fa-calendar mr-1"></i>{{ $log->created_at->format('d M Y, H:i') }}</span>
                    <span><i class="fa-solid fa-globe mr-1"></i>{{ $log->ip_address ?: 'Unknown IP' }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="p-10 text-center text-slate-500">
            <i class="fa-solid fa-inbox text-3xl mb-3 text-slate-300"></i>
            <p class="text-sm font-semibold">Belum ada log aktivitas yang ditemukan.</p>
        </div>
        @endforelse
    </div>
    
    {{-- Pagination --}}
    <div class="p-4 border-t border-slate-100 bg-slate-50/50">
        {{ $logs->links() }}
    </div>
</div>
@endsection
