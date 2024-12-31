<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class FormDataController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|string',
            'services' => 'nullable|array',
            'vehicle' => 'required|string',
        ]);

        // Check if 'services' field exists and is an array
        if ($request->has('services') && is_array($request->services)) {
            // Handle 'services' field
            // You can process or manipulate the 'services' field here if needed
        }

        // Store the data in the database
        $contactForm = new FormData();
        $contactForm->name = $request->name;
        $contactForm->email = $request->email;
        $contactForm->mobile = $request->mobile;
        $contactForm->services = implode(',', $request->services); // Assuming 'services' is an array
        $contactForm->vehicle = $request->vehicle;
        $contactForm->save();

        // Send email
          

          // Send a simple email to the submitted email address
          $toEmail = $validatedData['email'];
          $subject = 'Thanks Mail From Kanmani Moto Bikes';
          $message = 'We Received Your Enquiry, We will Reach You Soon';
          
          $toEmail2 = ['business@avatarprints.com', 'kanmanimotobikes@gmail.com'];
          $subject2 = 'New Enquiry Found from Kanmani Motobikes';
          $message2 = "Name: " . $validatedData['name'] . "\n";
          $message2 .= "Email: " . $validatedData['email'] . "\n";
          $message2 .= "Mobile: " . $validatedData['mobile'] . "\n";
          // Check if 'services' field exists and is an array before imploding
        if (isset($validatedData['services']) && is_array($validatedData['services'])) {
            $message2 .= "Services: " . implode(', ', $validatedData['services']) . "\n";
        }
          
          $message2 .= "Vehicle: " . $validatedData['vehicle'] . "\n";
          
  
          # EXAMPLE 1) Send the plain text email
          Mail::raw($message, function ($message) use ($toEmail, $subject) {
              $message->to($toEmail)
                      ->subject($subject );
          });
  
          Mail::raw($message2, function ($message) use ($toEmail2, $subject2) {
              $message->to($toEmail2)
                      ->subject($subject2);
          });

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Your message has been sent successfully.')
        ->with('show_message_window', true);
    }
}
