<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        $filter = $request->query('filter');
    
        $query = User::query();

        $query->whereHas('ranks', function ($q) use ($filter) {
            if ($filter === 'day') {
                $q->where('period_type', 'day');
            } elseif ($filter === 'month') {
                $q->where('period_type', 'month');
            } elseif ($filter === 'year') {
                $q->where('period_type', 'year');
            } else {
                $q->where('period_type', 'all');
            }
        });

        if ($search) {
            $query->orderByRaw("CASE WHEN id = ? THEN 0 ELSE 1 END", [$search]);
        }

        $users = $query->paginate(5)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html'  => view('components.frontend.leaderboard-table', ['users' => $users])->render(),
            ]);
        }
        return view('frontend.leaderboard.index', compact('users'));
    }
}
