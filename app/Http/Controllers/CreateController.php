<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Article;


class CreateController extends Controller
{
    public function home(){
        $articles = Article::all();
        return view('home', ['articles'=>$articles]);
        
    }

    public function create(){
        return view('create');
    }
    public function add(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        $articles = new Article;
        $articles->title = $request->input('title');
        $articles->description = $request->input('description');
        $articles->save();
        return redirect('/')->with('info', 'Article Saved Successfully');

    }
    public function update($id){
        $articles = Article::find($id);
        return view('/update', ['articles'=>$articles]);
    }
    public function edit(Request $request, $id){
        $data = array(
            'title'=>$request->input('title'),
            'description'=>$request->input('description')
        );
        $articles = Article::where('id', $id);
        $articles->update($data);
        return redirect('/')->with('info', 'Article Updated Successfully');
    }
    public function read($id){
        $articles = Article::find($id);
        return view('read', ['articles'=>$articles]);
    }
    public function delete($id){
        $articles = Article::where('id', $id);
        $articles->delete($id);
        return redirect('/')->with('info', 'Article Deleted Successfully');
    }
}
