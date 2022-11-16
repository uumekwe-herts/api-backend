<?php

namespace App\Http\Controllers;
use App\Models\Resource;
use Illuminate\Http\Request;


class ResourceController extends Controller
{
    public function addResource(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $resource = Resource::create([
            'title' => $validated['title'],
            'content' => $validated['content']
        ]);
        return response()->json(['number' => $resource]);
    }

    public function list()
    {
        $resources = Resource::all();
        return response()->json(['resources' => $resources]);
    }

    public function getResource(int $id)
    {
        $resource = Resource:: find($id);
        return response()->json(['resource' => $resource]);
    }
}
