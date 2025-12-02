<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller{
    
    public function index(){
        return "Hola, mundo";
    }

    public function show(){
        $articlesList = Article::where('user_id', auth()->id())->get();
        return view('articles', compact('articlesList'));
    }

    public function showID($id){

        $article = Article::find($id);

        if(!$article){
            abort(404);
        }

        return view('articleID', compact('article'));
    }

    public function create(){
        
        return view('create');
    }

    public function store(Request $request){
        //dd($request->all());
        $article = new Article();
        $article->id_art = $request->input('id_art');
        $article->titulo = $request->input('titulo');
        $article->cuerpo = $request->input('descripcion');
        $article->user_id = auth()->id();
        $article->save();

        return redirect()->route('articulos.show');
    }

    public function destroy($id){
        $article = Article::find($id);

        if(!$article){
            abort(404);
        }else{
            $article->delete();
            return redirect()->route('articulos.show')->with('success', 'Artículo eliminado con éxito.');
        }
    }

    public function edit($id){
        $article = Article::where('id_art', $id)->where('user_id', auth()->id())->first();

        if(!$article){
            abort(404);
        }

        return view('edit', compact('article'));
    }

    public function update(Request $request, $id){
        $article = Article::where('id_art', $id)->where('user_id', auth()->id())->first();

        if(!$article){
            abort(404);
        }else{
            $article->id_art = $request->input('id_art');
            $article->titulo = $request->input('titulo');
            $article->cuerpo = $request->input('descripcion');
            $article->save();
            return redirect()->route('articulos.show');
        }
    }
}
