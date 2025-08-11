<?php

namespace App\Http\Controllers;


use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Models\Category;

// use Illuminate\Database\Eloquent\Collection;

class ContactController extends Controller
{
    public function index()
    {

        // $contacts = Contact::with('category')->get();
        // $contacts = Contact::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        // $contacts = Contact::with('category')->CategorySearch($request->category_id)->get();
        $categories = Category::all();

        // $categories = array( array('id'=>'1', 'category'=>'dummy'));

// echo '<br />contacts';
// var_dump($contacts);
// // echo '<br />categories = ';
// // var_dump($categories);
// exit;

        return view('index', compact('categories'));    //'contacts', 
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
            'correct',
        ]);

        $categories = Category::all();
        $category_list=array();
        foreach($categories as $category){
            $category_list += array($category['id']=>$category['content']);
        }

        // return $contact;
        // return view('confirm');
        // return view('confirm', ['contact' => $contact]);
        return view('confirm', compact('contact', 'category_list', 'categories'));
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
            'category_id',
            'detail',
        ]);

        $contact['tel']=$request['tel-1'].$request['tel-2'].$request['tel-3'];

        if($request->input('correct') == 'correct'){
            return redirect('/')->withInput();
        }

        Contact::create($contact);
        return view('thanks');
    }


    public function admin(Request $request)
    {

        // $contacts = Contact::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        // $contacts  = array(array('id'=>'5', 'category'=> array('id'=>'1', 'category'=>'dummy'),'content' =>'なかみ中身'));
        // $contacts = Contact::all();

        $contacts = Contact::paginate(7);


        $pagination = true;
        $categories = Category::all();
        // $categories = array( array('id'=>'1', 'category'=>'dummy'));

        $category_list=array();
        foreach($categories as $category){
            $category_list += array($category['id']=>$category['content']);
        }

// echo '<br />contacts';
// var_dump($contacts);
// echo '<br />categories = ';
// var_dump($categories);

// echo '<br />contacts[0][content]';
// var_dump($contacts[0]['content']);
// echo '<br />categories';
// var_dump($categories);

        return view('admin', compact('contacts', 'category_list', 'categories', 'pagination'));//, 'categories'
    }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    // public function scopeCategorySearch($query, $category_id)
    // {
    //     if (!empty($category_id)) {
    //         $query->where('category_id', $category_id);
    //     }
    // }

    // public function scopeKeywordSearch($query, $keyword)
    // {
    //     if (!empty($keyword)) {
    //         $query->where('detail', 'like', '%' . $keyword . '%');
    //     }
    // }

    public function search(Request $request)
    {
        
        $contacts = Contact::with('category')->CategorySearch($request->category_id)->GenderSearch($request->gender)->KeywordSearch($request->keyword)->get();

        // $contacts = $contacts->paginate(7)->sortByDesc('created_at');

        $categories = Category::all();
        $pagination=false;

        $category_list=array();
        foreach($categories as $category){
            $category_list += array($category['id']=>$category['content']);
        }


// echo '<br />categories';
// var_dump($categories);
// echo '<br />category_list';
// var_dump($category_list);
// exit;

        return view('admin', compact('contacts', 'category_list', 'categories', 'pagination'));
    }

}
