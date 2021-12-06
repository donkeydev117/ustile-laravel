<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Color;
use App\Traits\ApiResponser;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ColorController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $colors = Color::get();
        return response()->json($colors, 200);
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
            'color' => 'string|required',
            'code' => 'string|required',
            'is_active' => 'required'
        ]);

        $data = [
            'color' => $request->input('color'),
            'code' => $request->input('code'),
            'key' => Str::slug($request->input('color')),
            'is_active' => $request->input('is_active'),
        ];

        Color::create($data);

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
            'code' => 'string|required',
            'color' => 'string|required',
            'is_active' => 'required'
        ]);

        $color = Color::find($id);

        $color->code = $request->input('code');
        $color->color = $request->input('color');
        $color->key = Str::slug($request->input('cololr'));
        $color->is_active = $request->input('is_active');

        $color->save();

        return response()->json(['status' => 'success', 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Color::find($id)->delete();

        return response()->json(['status' => 'success'], 200);
    }
}
