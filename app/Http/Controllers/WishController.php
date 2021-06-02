<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return Inertia::render('Wishes/Index', [
            'wishes' => Wish::latest()
                ->where('name', 'LIKE', "%" . $request->q . "%")
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('Wishes/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
         ]);

        $wish = new Wish;

        $wish->name = $request->name;
        $wish->description = $request->description;
        $path = $request->file('image')->storeAs('wishes', $request->file('image')->getClientOriginalName());
        $wish->image  =  '/' . $path;
        $wish->save();

        return redirect()->route('wishes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function show(Wish $wish)
    {
        //
        return Inertia::render('Wishes/Show', compact('wish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function edit(Wish $wish)
    {
        //
        return Inertia::render('Wishes/Edit', compact('wish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wish $wish)
    {
        dd($request, $wish); 
        $wish->update($request->all());

        return redirect()->route('wishes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wish $wish)
    {
        //
        $wish->delete();

        return redirect()->route('wishes.index');
    }

    public function buy(Request $request, Wish $wish)
    {
        $wish->update([
            'bought' => !$wish->bought 
        ]);

        return redirect()->route('wishes.index');
    }

    public function bought() {
        return Inertia::render('Wishes/Index', [
            'wishes' => Wish::where('bought', true)->get(),
        ]);
    }

    public function notBought() {
        return Inertia::render('Wishes/Index', [
            'wishes' => Wish::where('bought', false)->get(),
        ]);
    }
}
