@extends('layouts.app')

@section('title', 'Log Aktivitas Sistem')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6 bg-gray-50 border-b">
        <h3 class="text-lg font-bold text-gray-800">Riwayat Aktivitas</h3>
        <p class="text-sm text-gray-600">Daftar seluruh perubahan data yang dilakukan oleh pengguna.</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="text-left bg-gray-100 border-b">
                    <th class="px-6 py-3 text-xs font-semibold uppercase">Waktu</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase">Aktivitas</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase">URL</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase">IP Address</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase text-center">User Agent</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $log->created_at->format('d M Y, H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full
                            {{ str_contains($log->subject, 'Menambah') ? 'bg-green-100 text-green-700' :
                               (str_contains($log->subject, 'Menghapus') ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700') }}">
                            {{ $log->subject }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 italic">{{ $log->url }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $log->ip }}</td>
                    <td class="px-6 py-4 text-sm text-gray-400 truncate max-w-xs">{{ $log->agent }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">Belum ada aktivitas yang tercatat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t">
        {{ $logs->links() }}
    </div>
</div>
@endsection
