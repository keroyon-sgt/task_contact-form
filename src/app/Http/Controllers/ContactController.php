<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {

        $todos = Contact::with('category')->get();
        // $categories = Category::all();
        

        $categories = array( array('id'=>'1', 'category'=>'dummy'));

        return view('index', compact('todos', 'categories'));
    }

     public function correct(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel-1',
            'tel-2',
            'tel-3',
            'address',
            'building',
            'category_id',
            'detail',
        ]);

        
        // return $contact;
        // return view('confirm');
        // return view('confirm', ['contact' => $contact]);
        return view('index', compact('contact'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel-1',
            'tel-2',
            'tel-3',
            'address',
            'building',
            'category_id',
            'detail',
        ]);

        
        // return $contact;
        // return view('confirm');
        // return view('confirm', ['contact' => $contact]);
        return view('confirm', compact('contact'));
    }


    // public function store(Request $request)
    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            // 'tel-1',
            // 'tel-2',
            // 'tel-3',
            'address',
            'building',
            // 'category_id',
            'detail',
        ]);

        $contact['tel']=$request['tel-1'].$request['tel-2'].$request['tel-3'];

        Contact::create($contact);
        return view('thanks');
    }
}
