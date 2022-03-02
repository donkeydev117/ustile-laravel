<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProductTechnicalData;
use App\Traits\ApiResponser;
use Illuminate\Support\Str;

class ProductTechnicalDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $data = ProductTechnicalData::with('gallary.detail')->get();
        return response()->json($data, 200);
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
            'name' => 'string|required',
            'media' => 'numeric|required',
        ]);

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'image' => $request->input('media')
        ];

        ProductTechnicalData::create($data);

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
        //
        $request->validate([
            'name' => 'string|required',
            'media' => 'numeric|required',
        ]);

        $data = ProductTechnicalData::find($id);
        $data->name = $request->input('name');
        $data->slug = Str::slug($request->input('name'));
        $data->image = $request->input('media');

        $data->save();

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
        ProductTechnicalData::find($id)->delete();
        return response()->json(['status' => 'success'], 200);
    }
}
