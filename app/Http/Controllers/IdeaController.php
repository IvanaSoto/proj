<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\User;
use App\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{

    public function validate_idea(Request $request)
    {
        $this->validate($request, [
            'title'=> 'required|max:191|string',
            'text'=> 'nullable|string'
        ], [], [
            'title'=> 'Titulo',
            'text'=> 'Texto'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('idea.index', [
            'myIdeas' => Auth::user()->ideas,
            //'ideas' => DB::table('ideas')->get()
            'ideas' => Idea::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Idea::class);

        return view('idea.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Idea::class);

        $this->validate_idea($request);

        $idea = Idea::create([
            'title' => $request->title,
            'text' => $request->text,
            'user_id' => Auth::user()->id
        ]);
        
        Auth::user()->agreements()->attach( $idea );

        flash('La idea se ha creado correctamente')->success();

        return redirect()->action('IdeaController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        $this->authorize('view', $idea);

        return view('idea.show', [
            'idea' => $idea,
            'count' => $idea->agreements->where('pivot.like', true)->count()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function edit(Idea $idea)
    {
        $this->authorize('update', Idea::class);

        return view('idea.edit', [
            'idea' => $idea
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idea $idea)
    {
        $this->authorize('update', Idea::class);

        $this->validate_idea($request);

        $idea->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        return redirect()->action('IdeaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);

        $idea->delete();
        return redirect()->action('IdeaController@index');
    }

    /**
     * Add like to the idea.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function like(Idea $idea)
    {
                
        Auth::user()->agreements()->attach( $idea );

        return redirect()->action('IdeaController@index');
    }

    /**
     * Add dislike to the idea.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function dislike(Idea $idea)
    {
        
        Auth::user()->agreements()->attach( $idea, ['like' => false] );

        return redirect()->action('IdeaController@index');
    }
}
