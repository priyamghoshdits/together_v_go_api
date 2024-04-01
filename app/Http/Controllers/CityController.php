<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CityController extends Controller
{
    public function get_cities()
    {
        $cities = City::get();
        return response()->json(['success'=>1, 'data'=>$cities], 200,[],JSON_NUMERIC_CHECK);
    }

    public function save_cities(Request $request)
    {

//        return  $request->file('image')->getClientOriginalName();
        $cities = new City();
        $cities->name = $request['name'];

        if ($files = $request->file('image')) {
            // Define upload path
            $destinationPath = public_path('/cities/'); // upload path
            // Upload Orginal Image
            $file_name = $files->getClientOriginalName();
            $files->move($destinationPath, $file_name);
        }
//        $cities->image = $request['image'];
        $cities->image = $file_name ?? null;
        $cities->status = $request['status'] ?? null;
        $cities->save();
        return response()->json(['success'=>1, 'data'=>$cities], 200,[],JSON_NUMERIC_CHECK);
    }

    public function update_cities(Request $request)
    {
        $cities = City::find($request['id']);
        if ($files = $request->file('image')) {
            if (file_exists(public_path() . '/cities/' . $cities->image)) {
                File::delete(public_path() . '/cities/' . $cities->image);
            }
            $destinationPath = public_path('/cities/'); // upload path
            $profileImage1 = $files->getClientOriginalName();
            $files->move($destinationPath, $profileImage1);
        }
        $cities->name = $request['name'];
        $cities->image = $request['image'];
        $cities->status = $request['status'];
        $cities->update();
        return response()->json(['success'=>1, 'data'=>$cities], 200,[],JSON_NUMERIC_CHECK);
    }

    public function delete_cities($id)
    {
        $cities = City::find($id);
        if (file_exists(public_path() . '/cities/' . $cities->image)) {
            File::delete(public_path() . '/cities/' . $cities->image);
        }
        $cities->delete();
        return response()->json(['success'=>1, 'data'=>$cities], 200,[],JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }
}
