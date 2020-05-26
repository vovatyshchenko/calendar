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
    public function show()
    {
        $typeColors = TypeColor::where('user_id', auth()->user()->id)
            ->first();

        return response()->json($typeColors);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->only(['birthdays_active', 'tasks_active', 'activities_active', 'holidays_active', 'birthdays_color', 'tasks_color', 'activities_color', 'holidays_color']);
        TypeColor::where('user_id',auth()->user()->id)->update($request->all());

        return response(['message' => true], 200);
    }
}
