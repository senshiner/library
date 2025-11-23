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
        $totalBooks = Book::count();
        $totalMembers = Member::where('status', 'active')->count();
        $activeBorrows = Borrow::where('status', 'borrowed')->count();
        $overdueBorrows = Borrow::where('status', 'borrowed')
            ->where('due_date', '<', now())
            ->count();

        return view('library.dashboard', compact(
            'totalBooks',
            'totalMembers', 
            'activeBorrows',
            'overdueBorrows'
        ));
    }
}
