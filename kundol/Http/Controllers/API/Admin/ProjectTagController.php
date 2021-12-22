<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProjectTag;
use App\Traits\ApiResponser;
use Illuminate\Support\Str;

class ProjectTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = ProjectTag::all();

        return response()->json($tags, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'string|required',
            "is_active" => "string|required"
        ]);

        $data = [
            'title' => $request->title,
            'is_active' => $request->is_active == "active",
        ];

        ProjectTag::create($data);

        return response()->json(['status' => 'success' ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $request->validate([
            'title' => "string|required",
            'is_active' => 'string|required'
        ]);

        $tag = ProjectTag::find($id);
        
        $tag->title = $request->title;
        $tag->is_active = $request->is_active == "active";

        $tag->save();

        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tag = ProjectTag::find($id);

        $tag->delete();

        return response()->json(['status' => 'success'], 200);
    }
}
