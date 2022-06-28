<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Event::class);
        return view('events.index')
        ->with('events', Event::orderBy('date', 'DESC')->get())
        ->with('events_going', DB::table('eventparticipation')->where('user_id', '=', auth()->user()->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Event::class);
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Event::class);
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'date' => 'required',
            'location' => 'required',
            'file' => 'required|mimes:jpg,png,jpeg',
        ]);
        $newImageName = uniqid() . '-' . $request->title . '.' . $request->file->extension();
        $request->file->move(public_path('images/events'), $newImageName);

        Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image_path' => $newImageName,
            'date' => $request->input('date'),
            'location' => $request->input('location'),
            'user_id' => auth()->user()->id,
        ]);
        return redirect('/event')->with('message', 'Your event has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::where('id', $id)->first();
        $this->authorize('view', $event);


        if (Event::find($id)) {
            return view('events.show')
            ->with('event', Event::where('id', $id)->first())
            ->with('participiants', DB::table('eventparticipation')->join('users', 'user_id', '=', 'users.id')->where('event_id', '=', $id)->get());
        } else return redirect('/event');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::where('id', $id)->first();
        $this->authorize('update', $event);

        if (Event::find($id)) {
            return view('events.edit')
            ->with('event', Event::where('id', $id)->first());
        } else return redirect('/event');
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
        $event = Event::where('id', $id)->first();
        $this->authorize('update', $event);

        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'date' => 'required',
            'location' => 'required',
            'file' => 'nullable|mimes:jpg,png,jpeg',
        ]);

        if (isset($request->file)) {
            $newImageName = uniqid() . '-' . $request->title . '.' . $request->file->extension();
            $request->file->move(public_path('images/events'), $newImageName);
        }
        else $newImageName = $event->image_path;
        if ($newImageName != $event->image_path) File::delete(public_path('images/events/' . $event->image_path));

        $event->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'location' => $request->input('location'),
            'image_path' => $newImageName,
        ]);
        return redirect('/event')->with('message', 'Your event has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::where('id', $id)->first();
        $this->authorize('delete', $event);
        File::delete(public_path('images/events/' . $event->image_path));
        $event->delete();

        return redirect('/event');
    }

    public function going($id)
    {
        //$event = Event::where('id', $id)->first();

        DB::table('eventparticipation')->insert([
            'user_id' => auth()->user()->id,
            'event_id' => $id,
        ]);
        return redirect('/event');
    }
    public function notgoing($id)
    {
        DB::table('eventparticipation')->where('event_id', '=', $id)->where('user_id', '=',  auth()->user()->id)->delete();
        return redirect('/event');
    }
}
