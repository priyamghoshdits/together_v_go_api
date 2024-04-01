<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Http\Requests\StoreContactUsRequest;
use App\Http\Requests\UpdateContactUsRequest;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function get_contact_us()
    {
        $contactUs = ContactUs::get();
        return response()->json(['success'=>1, 'data'=>$contactUs], 200,[],JSON_NUMERIC_CHECK);
    }

    public function save_contact_us(Request $request)
    {
        $requestedData = (object)$request->json()->all();
        $contactUs = new ContactUs();
        $contactUs->email = $requestedData->email;
        $contactUs->phone = $requestedData->phone;
        $contactUs->subject = $requestedData->subject;
        $contactUs->message = $requestedData->message;
        $contactUs->save();
        return response()->json(['success'=>1, 'data'=>$contactUs], 200,[],JSON_NUMERIC_CHECK);
    }

    public function update_contact_us(Request $request)
    {
        $requestedData = (object)$request->json()->all();
        $contactUs = ContactUs::find($requestedData->id);
        $contactUs->email = $requestedData->email;
        $contactUs->phone = $requestedData->phone;
        $contactUs->subject = $requestedData->subject;
        $contactUs->message = $requestedData->message;
        $contactUs->update();
        return response()->json(['success'=>1, 'data'=>$contactUs], 200,[],JSON_NUMERIC_CHECK);
    }

    public function delete_contact_us($id)
    {
        $contactUs = ContactUs::find($id);
        $contactUs->delete();
        return response()->json(['success'=>1, 'data'=>$contactUs], 200,[],JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactUsRequest $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactUs $contactUs)
    {
        //
    }
}
