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
            'myIdeas' => Auth::user()->ideas()->where('user_id', Auth::user()->id)->get(),
            'ideas' => DB::table('ideas')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate_idea($request);

        $idea = Idea::create([
            'title' => $request->title,
            'text' => $request->text
        ]);
        
        Auth::user()->ideas()->attach( $idea );

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
        return view('idea.show', [
            'idea' => $idea,
            'count' => $idea->user()->where('like', 1)->count()
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
                
        Auth::user()->ideas()->attach( $idea );

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
        
        Auth::user()->ideas()->attach( $idea, ['like' => 0] );

        return redirect()->action('IdeaController@index');
    }
}
