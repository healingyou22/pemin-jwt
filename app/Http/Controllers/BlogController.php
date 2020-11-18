<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'blogId']]);
    }

    public function index()
    {
        $blog = Blog::all();
        return response()->json($blog);
    }

    public function blogId($id)
    {
        $blogId = Blog::find($id);

        if ($blogId) {
            return response()->json([
                'message' => 'tampil buku sesuai id',
                'data' => $blogId
            ], 200);
        } else {
            return response()->json([
                'message' => 'blog not found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'author' => 'required'
        ]);

        $blog = Blog::create(
            $request->only(['title', 'description', 'author'])
        );

        return response()->json([
            'created' => true,
            'data' => $blog
        ], 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'blog not found'
            ], 404);
        }

        $blog->fill(
            $request->only(['title', 'description', 'author'])
        );
        $blog->save();

        return response()->json([
            'updated' => true,
            'data' => $blog
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'blog not found'
                ]
            ], 404);
        }

        $blog->delete();

        return response()->json([
            'deleted' => true
        ], 200);
    }
}
