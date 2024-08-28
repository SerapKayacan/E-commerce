<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use App\Http\Resources\AuthorResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthorApiController extends Controller
{
    public function index()
    {

        $authors = Author::all();
        if ($authors) {
            return AuthorResource::collection($authors);
        } else {
            return response()->json([
                'message' => 'No record avaible'
            ], 200);
        }
    }



    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'author_type' => ['required', 'string', 'in:Local,Foreign'],
            'author_name' => ['required', 'string', 'max:255'],

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }
        $author = new Author();
        $author->author_type = $request->input('author_type');
        $author->author_name = $request->input('author_name');
        $author->save();


        return response()->json([
            'message' => 'Author created succesfully.',
            'data' => new AuthorResource($author)
        ], 200);
    }

    public function show($id)
    {
        $author = Author::find($id);
        if ($author) {
            return response()->json([
                'author' => $author
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Such Author Found!'
            ], 404);
        }
    }


    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'author_type' => ['required', 'string', 'in:Local,Foreign'],
            'author_name' => ['required', 'string', 'max:255'],

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }

        $author = Author::find($id);
        if ($author) {
            $author->author_type = $request->input('author_type');
            $author->author_name = $request->input('author_name');
            $author->update();
            return response()->json([
                'message' => 'Author Updated succesfully.',
                'data' => new AuthorResource($author)
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Such Author Found!'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $author = Author::withoutTrashed()->find($id);
        if ($author) {

            $author->delete();
            return response()->json([
                'message' => 'Author soft deleted successfully.',
                'data' => new AuthorResource($author)
            ], 200);
        }

        return response()->json([
            'message' => 'No Such Author Found!',

        ], 404);
    }
}
