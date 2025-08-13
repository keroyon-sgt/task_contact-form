<?php

namespace App\Http\Controllers;


use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

// use Illuminate\Database\Eloquent\Collection;

class ContactController extends Controller
{
    public function index()
    {

        $categories = Category::all();

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

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();

        return redirect('/admin');//->with('message', 'お問い合わせを削除しました');
    }

    public function admin(Request $request)
    {

        $contacts = Contact::paginate(7);


        $categories = Category::all();

        $category_list=array();
        foreach($categories as $category){
            $category_list += array($category['id']=>$category['content']);
        }

        $form_action = '/export';

        return view('admin', compact('contacts', 'category_list', 'categories', 'request', 'form_action'));
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
        
        $contacts = Contact::with('category')
        // $contacts = Contact::query()
            ->CategorySearch($request->category_id)
            ->DateSearch($request->created_at)
            ->GenderSearch($request->gender)
            ->KeywordSearch($request->keyword)
            ->get();
        
        // $contacts = $contacts->paginate(7)->withQueryString();
// echo '<br />contacts = ';
// var_dump($contacts);

        $query = Contact::query();
        if ($value = $request->category_id) {
            $query->where('category_id', $value);

// echo '<br /><br />value(category_id) = ';
// var_dump($value);
// echo '<br /><br />query = ';
// var_dump($query);

        }
        if ($value = $request->gender) {
            $query->where('gender', $value);

// echo '<br /><br />value(g) = ';
// var_dump($value);
// echo '<br /><br />query = ';
// var_dump($query);

        }
        if ($value = $request->created_at) {
            $query->where('created_at', $value.'%');

// echo '<br /><br />value(c) = ';
// var_dump($value);
// echo '<br /><br />query = ';
// var_dump($query);

        }
        if ($value = $request->keyword) {
            $query->where('email', 'LIKE', "%{$value}%")
                ->orWhere('detail', 'LIKE', "%{$value}%")
                ->orWhere('email', 'LIKE', "%{$value}%")
                ->orWhere('last_name', 'LIKE', "%{$value}%")
                ->orWhere('first_name', 'LIKE', "%{$value}%");

// echo '<br /><br />value(k) = ';
// var_dump($value);
// echo '<br /><br />query = ';
// var_dump($query);


        }
        $contacts = $query->paginate(7)->withQueryString();

// echo '<br /><br />category_id = ';
// var_dump($request->category_id);
// echo '<br /><br />gender = ';
// var_dump($request->gender);
// echo '<br /><br />created_at = ';
// var_dump($request->created_at);
// echo '<br /><br />keyword = ';
// var_dump($request->keyword);

// echo '<br /><br />contacts = ';
// var_dump($contacts);
// exit;

        $categories = Category::all();

        $category_list=array();
        foreach($categories as $category){
            $category_list += array($category['id']=>$category['content']);
        }

        $form_action = '/export/search';

// echo '<br />categories';
// var_dump($categories);
// echo '<br />category_list';
// var_dump($category_list);
// exit;

        return view('admin', compact('contacts', 'category_list', 'request', 'form_action'));
    }

    public function test(){ return view('test'); }
    public function test_js01(){ return view('test_js01'); }
    public function test_js02(){ return view('test_js02'); }

    public function thanks(){ return view('thanks'); }


}
