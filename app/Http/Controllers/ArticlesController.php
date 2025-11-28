<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller{
    
    public function index(){
        return "Hola, mundo";
    }

    public function show(){
        $articlesList = Article::all();
        //$myArticle = Article::findOrFail($id);
        //$articlesList = Article::where('id', '>', 100)->get();
        //$articlesList = Article::where('id', '>', 100)->take(10)->get();
        //$maxId = Article::max('id');

        return view('articles', compact('articlesList'));
        /*$id = '12345678A';
        $username = 'Javi';
        $articles = collect([
        [
        'nombre' => 'Articulo 1', 
        'precio' => 'Precio Articulo 1', 
        'descripcion' => 'Descripción 1'
        ],
        [
        'nombre' => 'Articulo 2', 
        'precio' => 'Precio Articulo 2', 
        'descripcion' => 'Descripción 2'
        ]
    ]);

        return view('articles', compact('id', 'username', 'articles'));*/
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
}
