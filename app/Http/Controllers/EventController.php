<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\User;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('event_creation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$event = new Event;
    	$event->nom = $request->nom;
    	$debut = strtotime($request->debutDate.' '.$request->debutHeure);
    	$fin = strtotime($request->finDate.' '.$request->finHeure);

    	$event->debut = strtotime($request->debutDate.' '.$request->debutHeure);
    	$event->fin = strtotime($request->finDate.' '.$request->finHeure);
    	$event->stylemusical = $request->stylemusical;
    	$event->billetterie = $request->billetterie;
        $event->textbox = $request->textbox;
        $event->liste_groupes = json_encode($request->liste_groupes);
        dd(json_encode($request->liste_groupes));
        $event->save();
        $user = Auth::User();
        $event->users()->sync($user);
        // $user->events()->sync($event);
        // $event->users()->sync($event);

        return redirect()->route('orga');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userall(Request $request)
    {
        $events = $request->user()->events;

        return view('event_list_orga', compact('events'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $events = Event::all();

        // if($request->nom || $request->debut || $request->fin || $request->group){
        //     dump($events->where('nom', 'like', $request->nom .'%')->first());
        // }

        foreach ($events as $event) {
            $evd = date("y-d-m", $event->debut);
            $reqd = $request->debut;
            $reqf = $request->fin;
            if($evd === $reqd){
                dump($event->nom);
            }
        }
        // dump($events);
        return view('event_search', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}