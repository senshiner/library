<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrow;
use App\Models\Category;
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
                                ->count(),
        ];

        // Rasio keterlambatan (persen)
        $stats['overdueRatio'] = $stats['activeBorrows'] > 0
            ? (int) round(($stats['overdueBorrows'] / $stats['activeBorrows']) * 100)
            : 0;

        // Recent borrows for activity feed (used as part of unified activities)
        $recentBorrows = Borrow::with(['book', 'member', 'user'])
            ->where('status', 'borrowed')
            ->orderBy('borrow_date', 'desc')
            ->limit(5)
            ->get();

        // Upcoming due (next 7 days)
        $upcomingDue = Borrow::with(['book', 'member'])
            ->where('status', 'borrowed')
            ->whereBetween('due_date', [now(), now()->addDays(7)])
            ->orderBy('due_date', 'asc')
            ->limit(5)
            ->get();

        // Popular books by borrow count (top 5)
        $popularBooks = Book::withCount('borrows')
            ->orderByDesc('borrows_count')
            ->limit(5)
            ->get();

        // Top categories by book count
        $topCategories = Category::withCount('books')
            ->orderByDesc('books_count')
            ->limit(3)
            ->get();

        // Build unified activity feed: recent book additions, borrows, and returns
        $recentReturns = Borrow::with(['book', 'member', 'user'])
            ->where('status', 'returned')
            ->orderBy('return_date', 'desc')
            ->limit(5)
            ->get();

        $recentBooksAdded = Book::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $activities = collect();

        foreach ($recentBooksAdded as $b) {
            $activities->push((object) [
                'type' => 'book_added',
                'title' => $b->title,
                'message' => "Buku {$b->title} ditambahkan",
                'date' => $b->created_at,
            ]);
        }

        foreach ($recentBorrows as $br) {
            $activities->push((object) [
                'type' => 'borrowed',
                'title' => $br->book->title,
                'message' => "{$br->member->name} meminjam \"{$br->book->title}\"",
                'date' => $br->borrow_date,
            ]);
        }

        foreach ($recentReturns as $rr) {
            $activities->push((object) [
                'type' => 'returned',
                'title' => $rr->book->title,
                'message' => "{$rr->member->name} mengembalikan \"{$rr->book->title}\"",
                'date' => $rr->return_date ?? $rr->updated_at,
            ]);
        }

        // Sort activities by date desc and limit
        $activities = $activities->sortByDesc('date')->take(10)->values();

        // Gunakan view dashboard (bukan library.dashboard)
        return view('dashboard', compact('stats', 'recentBorrows', 'upcomingDue', 'popularBooks', 'activities', 'topCategories'));
    }
}