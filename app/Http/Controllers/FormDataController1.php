<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormDataController extends Controller
{
    public function store(Request $request)
{
    $contactForm = new FormData();
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'mobile' => 'required|string',
        'services' => 'nullable|array',
        'vehicle' => 'required|string',
    ]);

    // Store the data in the database
   

    $contactForm->name = $request->name;
    $contactForm->email = $request->email;
    $contactForm->mobile = $request->mobile;
    $contactForm->services = implode(',', $request->services);
    $contactForm->vehicle = $request->vehicle;
    $contactForm->save();

    // Send email
    Mail::to(config('mail.from.address'))->send(new ContactFormMail($contactForm));

    // Redirect back or to a success page
    return redirect()->back()->with('success', 'Your message has been sent successfully.');
}

}
