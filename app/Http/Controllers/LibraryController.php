<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrow;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'totalBooks' => Book::count(),
            'totalMembers' => Member::where('status', 'active')->count(),
            'activeBorrows' => Borrow::where('status', 'borrowed')->count(),
            'overdueBorrows' => Borrow::where('status', 'borrowed')
                                ->where('due_date', '<', now())
                                ->count()
        ];

        // Recent borrows for activity feed
        $recentBorrows = Borrow::with(['book', 'member'])
            ->where('status', 'borrowed')
            ->orderBy('borrow_date', 'desc')
            ->limit(5)
            ->get();

        // Gunakan view dashboard (bukan library.dashboard)
        return view('dashboard', compact('stats', 'recentBorrows'));
    }
}