<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\Article;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $article = Article::all();

        return view('article.index')->with('article',$article);
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());
        if(isset($request->file_attachment)){
            $upload = $this->upload($request->file_attachment, 'article',$article->id);
            $article->file_attachments()->create([
                'file_path'=>$upload['file_path'],
                'file_name'=>$upload['file_name'],
                'file_type'=>$upload['file_type'],
            ]);
        }
        return redirect()->route('article.index')->withSuccess('Data saved');
    }

    public function edit(Article $article)
    {
        return view('article.create')->with('article',$article);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        
        if(isset($request->file_attachment)){
            $upload = $this->upload($request->file_attachment, 'article',$article->id);
            $article->file_attachments()->create([
                'file_path'=>$upload['file_path'],
                'file_name'=>$upload['file_name'],
                'file_type'=>$upload['file_type'],
            ]);
        }
        return redirect()->route('article.index')->withSuccess('Data updated');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('article.index')->withSuccess('Data deleted');
    }

}
