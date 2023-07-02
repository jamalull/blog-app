<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Exception;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // $posts = Post::latest()->paginate(10);
        $posts = Post::all();
        return sendResponse(PostResource::collection($posts), 'Posts retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title"     => "required|unique:posts,title",
            "cover"     => "required",
            "desc"      => "required",
            "category"  => "required",
            // "tags"      => "array|required",  
            "keywords"  => "required",
            "meta_desc" => "required",
        ]);

        if ($validator->fails()) return sendError('Validation Error.', $validator->errors(), 422);
        
        // $post               = new Post();
        $cover              = $request->file('cover');
        if($cover){
            $cover_path     = $cover->store('images/blog', 'public');
            // $post->cover    = $cover_path;
        }

        try {
            // $post = Post::create([
            //     'cover'        => $cover_path,
            //     'title'        => $request->title,
            //     'slug'         => \Str::slug($request->title),
            //     'user_id'      => Auth::user()->id,
            //     'category_id'  => $request->category,
            //     'desc'         => $request->desc,
            //     'keywords'     => $request->keywords,
            //     'meta_desc'    => $request->meta_desc,
            // ]);
            $post               = new Post();

            $cover              = $request->file('cover');
            if($cover){
                $cover_path     = $cover->store('images/blog', 'public');
                $post->cover    = $cover_path;
            }
            $post->title        = $request->title;
            $post->slug         = \Str::slug($request->title);
            $post->user_id      = Auth::user()->id;
            $post->category_id  = $request->category;
            $post->desc         = $request->desc;
            $post->keywords     = $request->keywords;
            $post->meta_desc    = $request->meta_desc;
            $post->save();

            $post->tags()->attach($request->tags);
            $success = new PostResource($post);
            // $success = $post;
            $message = 'Yay! A post has been successfully created.';
        } catch (Exception $e) {
            $success = [];
            $message = 'Oops! Unable to create a new post.';
        }

        return sendResponse($success, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (is_null($post)) return sendError('Post not found.');

        return sendResponse(new PostResource($post), 'Post retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post    $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Post $post, $id)
    {
        $validator = Validator::make($request->all(), [
            "title"     => "required|unique:posts,title",
            "cover"     => "required",
            "desc"      => "required",
            "category"  => "required",
            // "tags"      => "array|required",  
            "keywords"  => "required",
            "meta_desc" => "required",
        ]);

        if ($validator->fails()) return sendError('Validation Error.', $validator->errors(), 422);

        $post = Post::findOrFail($id);

        $new_cover = $request->file('cover');

        if($new_cover){
            if($post->cover && file_exists(storage_path('app/public/' . $post->cover))){
                \Storage::delete('public/'. $post->cover);
            }

            $new_cover_path = $new_cover->store('images/blog', 'public');

            $post->cover = $new_cover_path;
        }

        try {
            $post->title        = $request->title;
            $post->slug         = $request->slug;
            $post->user_id      = Auth::user()->id;
            $post->category_id  = $request->category;
            $post->desc         = $request->desc;
            $post->keywords     = $request->keywords;
            $post->meta_desc    = $request->meta_desc;
            $post->save();

            $post->tags()->sync($request->tags);

            $success = new PostResource($post);
            $message = 'Yay! Post has been successfully updated.';
        } catch (Exception $e) {
            $success = [];
            $message = 'Oops, Failed to update the post.';
        }

        return sendResponse($success, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return sendResponse([], 'The post has been successfully deleted.');
        } catch (Exception $e) {
            return sendError('Oops! Unable to delete post.');
        }
    }
}