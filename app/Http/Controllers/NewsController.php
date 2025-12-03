<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('date', 'desc')->get();

        return view('news.index', [
            'news' => $news
        ]);
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2',
            'date' => 'required|date',
            'summary' => 'required',
            'content' => 'required',
        ]);

        News::create($request->all());

        return redirect()->route('news.index')
            ->with('feedback.message', 'Novedad publicada con éxito.');
    }

    public function edit($id)
    {
        return view('news.edit', [
            'news' => News::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:2',
            'date' => 'required|date',
            'summary' => 'required',
            'content' => 'required',
        ]);

        $news = News::findOrFail($id);
        $news->update($request->all());

        return redirect()->route('news.index')
            ->with('feedback.message', 'Novedad actualizada con éxito.');
    }

    public function delete($id)
    {
        return view('news.delete', [
            'news' => News::findOrFail($id)
        ]);
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('news.index')
            ->with('feedback.message', 'Novedad eliminada con éxito.');
    }
}

