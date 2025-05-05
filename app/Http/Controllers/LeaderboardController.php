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

        if ($search) {
            $query->where('id', $search);
        }

        $query->withSum([
            'activities as period_points' => function($q) use ($filter) {
                if ($filter === 'day') {
                    $q->whereDate('performed_at', now());
                } elseif ($filter === 'month') {
                    $q->whereMonth('performed_at', now()->month)
                      ->whereYear('performed_at', now()->year);
                } elseif ($filter === 'year') {
                    $q->whereYear('performed_at', now()->year);
                }
            }
        ], 'points');

        $query->orderByDesc('period_points');

        $users = $query->paginate(5)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html'  => view('components.frontend.leaderboard-table', ['users' => $users])->render(),
            ]);
        }
        return view('frontend.leaderboard.index', compact('users'));
    }
}
