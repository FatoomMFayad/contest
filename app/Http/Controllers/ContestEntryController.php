<?php

namespace App\Http\Controllers;


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
    }
}
