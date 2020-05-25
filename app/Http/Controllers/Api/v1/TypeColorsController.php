<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\TypeColor;
use Illuminate\Http\Request;

class TypeColorsController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $typeColor = TypeColor::where('id',$id)
            ->where('user_id', auth()->user()->id)
            ->first();

        return response()->json($typeColor);
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
        $typeColor = TypeColor::findOrFail($id);
        $typeColor->update($request->all());

        return $typeColor;
    }
}
