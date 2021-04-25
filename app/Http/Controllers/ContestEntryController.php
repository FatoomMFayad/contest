<?php

namespace App\Http\Controllers;

use App\Events\NewEntryReceivedEvent;
use Illuminate\Http\Request;
use App\Models\ContestEntry;

class ContestEntryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);
        ContestEntry::create($data);

        event(NewEntryReceivedEvent::class);
    }
}
