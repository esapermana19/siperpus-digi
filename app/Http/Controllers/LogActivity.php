<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogActivity extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter');
        $query = \App\Models\LogActivity::query();

        // Filter berdasarkan rentang waktu menggunakan Carbon
        $query->when($filter, function ($q) use ($filter) {
            if ($filter == 'harian') {
                return $q->whereDate('created_at', \Carbon\Carbon::today());
            }
            if ($filter == 'mingguan') {
                return $q->whereBetween('created_at', [
                    \Carbon\Carbon::now()->startOfWeek(),
                    \Carbon\Carbon::now()->endOfWeek()
                ]);
            }
            if ($filter == 'bulanan') {
                return $q->whereMonth('created_at', \Carbon\Carbon::now()->month)
                    ->whereYear('created_at', \Carbon\Carbon::now()->year);
            }
        });

        $logs = $query->latest()->paginate(20)->withQueryString();

        return view('logactivity.index', compact('logs'));
    }
}
