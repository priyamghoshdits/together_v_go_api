<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    public function get_testimonial()
    {
        $testimonial = Testimonial::get();
        return response()->json(['success'=>1, 'data'=>$testimonial], 200,[],JSON_NUMERIC_CHECK);
    }

    public function save_testimonial(Request $request)
    {
        $testimonial = new Testimonial();
        $testimonial->image = $testimonial['image'];
        $testimonial->name = $testimonial['name'];
        $testimonial->star = $testimonial['star'];
        $testimonial->description = $testimonial['description'];
        $testimonial->save();

        if ($files = $request->file('image')) {
            // Define upload path
            $destinationPath = public_path('/testimonial/'); // upload path
            // Upload Orginal Image
            $profileImage1 = $files->getClientOriginalName();
            $files->move($destinationPath, $profileImage1);
        }

        return response()->json(['success'=>1, 'data'=>$testimonial], 200,[],JSON_NUMERIC_CHECK);
    }

    public function update_testimonial(Request $request)
    {
        $testimonial = Testimonial::find($request['id']);
        if ($files = $request->file('image')) {
            if (file_exists(public_path() . '/testimonial/' . $testimonial->image)) {
                File::delete(public_path() . '/testimonial/' . $testimonial->image);
            }
            $destinationPath = public_path('/testimonial/'); // upload path
            $profileImage1 = $files->getClientOriginalName();
            $files->move($destinationPath, $profileImage1);
        }
        $testimonial->image = $testimonial['image'] ?? $testimonial->image;
        $testimonial->name = $testimonial['name'] ?? $testimonial->name;
        $testimonial->star = $testimonial['star'] ?? $testimonial->star;
        $testimonial->description = $testimonial['description'] ?? $testimonial->description;
        $testimonial->update();
        return response()->json(['success'=>1, 'data'=>$testimonial], 200,[],JSON_NUMERIC_CHECK);
    }

    public function delete_testimonial($id)
    {
        $testimonial = Testimonial::find($id);
        if (file_exists(public_path() . '/testimonial/' . $testimonial->image)) {
            File::delete(public_path() . '/testimonial/' . $testimonial->image);
        }
        $testimonial->delete();
        return response()->json(['success'=>1, 'data'=>$testimonial], 200,[],JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        //
    }
}
