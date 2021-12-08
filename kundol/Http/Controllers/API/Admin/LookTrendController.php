<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\LookTrend;
use App\Traits\ApiResponser;
use Illuminate\Support\Str;

class LookTrendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $looktrends = LookTrend::get();
        return response()->json($looktrends, 200);
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
        $request->validate([
            'name' => 'string|required',
            'media' => 'string|required',
        ]);

        $data = [
            'name' => $request->input('name'),
            'key' => Str::slug($request->input('name')),
            'media' => $request->input('media')
        ];

        LookTrend::create($data);

        return response()->json(['status' => 'success'], 200);
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
        $request->validate([
            'name' => 'string|required',
            'media' => 'string|required'
        ]);

        $looktrend = LookTrend::find($id);
        $looktrend->name = $request->input('name');
        $looktrend->media = $request->input('media');
        $looktrend->key = Str::slug($request->input('name'));

        $looktrend->save();

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
        $looktrend = LookTrend::find($id);
        $looktrend->delete();

        return response()->json(['status' => 'success'], 200);
    }
}
