<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
 public function AdminContact(){
     $contact = Contact::all();
    return view('admin.contact.index',compact('contact')); 

 }

 public function AdminAddContact()
 {
     return view('admin.contact.create');
 }

 public function StoreAdminContact(Request $request){
    
    $validated_data= $request->validate( [
        'address' => 'required|regex:/(^[A-Za-z-0-9.,\/ ]+$)/',
        'email'=> 'required|email|unique:users',
        'phone' => 'required|digits:10|unique:contacts',


    ],
    [
        'address.required' => 'Address Is Required',
        'email.required' => 'Email Is Required',
        'phone.required' => 'Address Is Required',


    ]


);
        
Contact::insert([
    'address' => $request->address,
    'email' => $request->email,
    'phone' => $request->phone,
    'created_at' => Carbon::now()

]);

    return Redirect()->back() ->with('success', 'Contact Successfully Added');

 }


  public function EditAdminContact($id){
        $contact = Contact::find($id);
        return view ('admin.contact.edit', compact('contact'));
  }


 public function UpdateContact(Request $request, $id){
    $validated_data= $request->validate( [
        'address' => 'regex:/(^[A-Za-z-0-9.,\/ ]+$)/',
        'email'=> 'email|unique:users',
        'phone' => 'digits:10',


    ]);
   
    Contact::find($id)->update([
        'address' => $request->address,
        'email' => $request->email,
        'phone' => $request->phone,
        'created_at' => Carbon::now()

    ]);
    return Redirect()->back()->with('success', 'Contact Updated Successfully');

 }

 public function DeleteContact($id){
    {
       
        Contact::find($id)->delete();
        return Redirect()->back()->with('success', 'Contact Deleted Successfully');
    }

 }

 public function Contact(){
    $contact = DB::table('contacts')->first();
    return view('pages.contact', compact('contact'));
 }

 public function ContactForm(Request $request){
    ContactForm::insert([
        'name'=> $request->name ,
        'email'=> $request->email ,
        'subject'=> $request->subject ,
        'message'=> $request->message ,
        'created_at'=> Carbon::now(),


    ]);
    return Redirect()->route('contact')->with('success', 'Contact Succesfully Done');
 }
}
