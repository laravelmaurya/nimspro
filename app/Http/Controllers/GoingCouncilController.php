<?php

namespace App\Http\Controllers;

use App\Models\GoingCouncil;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreGoingCouncilRequest;
use App\Http\Requests\UpdateGoingCouncilRequest;

class GoingCouncilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGoingCouncilRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GoingCouncil $goingCouncil)
    {
        //
    }

    public function edit($id)
    {
        $goingCouncil = GoingCouncil::findOrFail($id);
        return view('going-councils.edit', compact('goingCouncil'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $goingCouncil = GoingCouncil::findOrFail($id);
        $goingCouncil->body = $request->body;
        $goingCouncil->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Going Council added successfully!'
        ]);
        // return redirect()->route('going-councils.edit', $id)->with('success', 'GoingCouncil updated successfully');
    }
}
