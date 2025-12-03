<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Rating;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        $eventsQuery = Event::with(['rating', 'categories']);

        $searchParams = [
          's-name' => $request->query('s-name'),
          's-rating' => $request->query('s-rating'),
        ];

        if($searchParams['s-name']){
            $eventsQuery->where('name', 'like', '%'.$searchParams['s-name'].'%');
        }

        if($searchParams['s-rating']){
            $eventsQuery->where('rating_fk', '=', $searchParams['s-rating']);
        }

        $allEvents = $eventsQuery->paginate(2)->withQueryString();

        return view('events.index', [
            'events' => $allEvents,
            'ratings' => Rating::all(),
            'searchParams' => $searchParams,
        ]);
    }

    public function view(Event $event)
    {
        return view('events.view',[
            'event' => $event
        ]);
    }

    public function create()
    {


        return view('events.create',[
            'categories' => Category::orderBy('name')->get(),
            'ratings' => Rating::all(),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
             'name' => ['required','min:2'],
             'ticket_price' => 'required|numeric',
             'date' => 'required'
        ],[
            'name.required' => 'El nombre debe tener un valor',
            'name.min' => 'El nombre debe tener al menos :min caracteres',
            'ticket_price.required' => 'El precio debe tener un valor',
            'ticket_price.numeric' => 'El precio debe ser un valor numerico',
            'date.required' => 'la fecha debe tener un valor'
        ]);

        $input = $request->all();

        if($request->hasFile('cover')){
            $input['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $event = Event::create($input);
        $event->categories()->attach($input['category_id'] ?? [] );

        return redirect()
            ->route('events.index')
            ->with('feedback.message', 'El evento <b>'. e($input['name']) .'</b> se publicó exitosamente');

    }

    public function delete (int $id)
    {
        return view('events.delete', [
            'event' => Event::findOrFail($id),
        ]);
    }

    public function destroy(int $id)
    {
        $event = Event::find($id);
        $event->categories()->detach();
        $event->delete($id);

        if($event->cover){
            Storage::disk('public')->delete($event->cover);
        }

        return redirect()
            ->route('events.index')
            ->with('feedback.message', 'El evento <b>'. e($event->name) .'</b> se eliminó exitosamente');


    }

    public function edit(Event $event)
    {
        return view('events.edit', [
            'event' => $event,
            'ratings' => Rating::all(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $event = Event::find($id);
        $input = $request->except('_token'. '_method');
        $oldCover = $event->cover;

        $request->validate([
             'name' => ['required','min:2'],
             'ticket_price' => 'required|numeric',
             'date' => 'required'
        ],[
            'name.required' => 'El nombre debe tener un valor',
            'name.min' => 'El nombre debe tener al menos :min caracteres',
            'ticket_price.required' => 'El precio debe tener un valor',
            'ticket_price.numeric' => 'El precio debe ser un valor numerico',
            'date.required' => 'la fecha debe tener un valor'
        ]);
        if($request->hasFile('cover')){
            $input['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $event->update($input);
        $event->categories()->sync($request->input('category_id', []));

        if($oldCover && $request->hasFile('cover')){
            Storage::disk('public')->delete($oldCover);
        }

        return redirect()
            ->route('events.index')
            ->with('feedback.message', 'El evento <b>'. e($event->name) .'</b> se actualizó exitosamente');

    }
}
