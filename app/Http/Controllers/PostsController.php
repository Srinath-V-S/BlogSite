<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
class PostsController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth',['except'=>['index','show']]);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        $posts = Post::orderBy('created_at','desc')->paginate(2);

        return view('Posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
           'title' => 'required',
           'body' => 'required',
           'post_image'=>'image|nullable|max:1999',
         ]);
         // upload handling
         if($request->hasFile('post_image')){
            // getting filename with extension
            $filename_with_ext = $request->file('post_image')->getClientOriginalName();
            // isolating just the filename
            $filename = pathinfo($filename_with_ext,PATHINFO_FILENAME);
            // Get just extensions
            $extension = $request->file('post_image')->getClientOriginalExtension();
            //filename to store
            $filename_to_store  = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('post_image')->storeAs('public/post_images',$filename_to_store);
         }
         else{
           $filename_to_store = 'noimage.jpg';
         }

        $post = new Post;
        $post->title = $request->input('title');
        $post->Body = $request->input('body');
        $post->user_id = Auth()->user()->id;
        $post->post_image = $filename_to_store;
        $post->save();


        return redirect('/posts')->with('success','Post created Succesfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id);
        return view('Pages.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  Post::find($id);
        if(auth()->user()->id !== $post->user->id){
            return redirect('/posts')->with('error',"Unauthorised Access!");

        }
        return view('Posts.edit')->with('post',$post);
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
      if($request->hasFile('post_image')){
         // getting filename with extension
         $filename_with_ext = $request->file('post_image')->getClientOriginalName();
         // isolating just the filename
         $filename = pathinfo($filename_with_ext,PATHINFO_FILENAME);
         // Get just extensions
         $extension = $request->file('post_image')->getClientOriginalExtension();
         //filename to store
         $filename_to_store  = $filename.'_'.time().'.'.$extension;
         // upload image
         $path = $request->file('post_image')->storeAs('public/post_images',$filename_to_store);
      }


      $this->validate($request,[
        'title' => 'required',
        'body' => 'required',
      ]);
     $post = Post::find($id);
     $post->title = $request->input('title');
     $post->Body = $request->input('body');

     if($request->hasFile('post_image')){
       $post->post_image = $filename_to_store;
     }
     $post->save();


     return redirect('/posts')->with('success','Post Updated Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post =  Post::find($id);
      if(auth()->user()->id !== $post->user->id){
          return redirect('/posts')->with('error',"Unauthorised Access!");

      }
      if($post->post_image!='noimage.jpg'){
        Storage::delete('public/post_images/'.$post->post_image);
      }

      $post->delete();
      return redirect('/posts')->with('success','Post Removed Succesfully!');

    }
}
