<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $selected = Carbon::parse($request->query('date', now()));
        $user = $request->user();

        $notes = $user->notes()
            ->whereYear('created_at', $selected->year)
            ->whereMonth('created_at', $selected->month)
            ->get()
            ->groupBy(fn ($note) => $note->created_at->format('Y-m-d'));

        $start = $selected->copy()->startOfMonth()->startOfWeek();
        $end = $selected->copy()->endOfMonth()->endOfWeek();
        $period = CarbonPeriod::create($start, '1 day', $end);

        $calendar = collect($period)->chunk(7)->map(function ($week) {
            return $week;
        });

        return view('calendar.index', [
            'selected' => $selected,
            'calendar' => $calendar,
            'notesByDate' => $notes,
        ]);
    }
}
