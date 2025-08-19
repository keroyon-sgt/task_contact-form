<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Contact;
use App\Models\Category;


class CsvExportController extends Controller
{
    public function export()
    {

            $csvHeader = [
            'id',
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            // 'tel-1',
            // 'tel-2',
            // 'tel-3',
            'address',
            'building',
            'category',
            'detail',
            'created_at',
            'updated_at',
        ];


        $contacts = Contact::all();
        $contacts = $contacts->toArray();

        $categories = Category::all();

        $category_list=array();
        foreach($categories as $category){
            $category_list += array($category['id']=>$category['content']);
        }

// echo '<br /><br />value(csvData) = ';
// var_dump($csvData);

        $csvData=array();
        foreach($contacts as $data_id => $contact){

// echo '<br /><br />contact = ';
// var_dump($contact);

            switch ($contact['gender']) {
                case 1:
                    $gender = "男性";
                    break;
                case 2:
                    $gender = "女性";
                    break;
                case 3:
                    $gender = "その他";
                    break;
            }

            $csvData[ $data_id ]= array(
                $contact['id'],
                $contact['last_name'],
                $contact['first_name'],
                $gender,
                $contact['email'],
                $contact['tel'],
                $contact['address'],
                $contact['building'],
                $category_list[ $contact['category_id'] ],
                $contact['detail'],
                $contact['created_at'],
                $contact['updated_at'],
            );

// echo '<br /><br />contact = ';
// var_dump($contact);
        }

// echo '<br /><br />csvData = ';
// var_dump($csvData);
// exit;

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);

        return $response;
    }

    public function search(Request $request)
    {
        
        $csvHeader = [
            'id',
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            // 'tel-1',
            // 'tel-2',
            // 'tel-3',
            'address',
            'building',
            'category',
            'detail',
            'created_at',
            'updated_at',
        ];


        $contacts = Contact::with('category')
        // $contacts = Contact::query()
            ->CategorySearch($request->category_id)
            ->DateSearch($request->created_at)
            ->GenderSearch($request->gender)
            ->KeywordSearch($request->keyword)
            ->get();

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


        // $contacts = $query->paginate(100)->withQueryString();
        $contacts = $query->paginate(0)->withQueryString();

// echo '<br /><br />contacts = ';
// var_dump($contacts);

        // $contacts = $contacts->toArray();
        // $contacts = $contacts->all();

// echo '<br /><br />contacts = ';
// var_dump($contacts);



        $categories = Category::all();

        $category_list=array();
        foreach($categories as $category){
            $category_list += array($category['id']=>$category['content']);
        }

// echo '<br /><br />value(csvData) = ';
// var_dump($csvData);

        $csvData=array();
        foreach($contacts as $data_id => $contact){

// echo '<br /><br />contact = ';
// var_dump($contact);

            switch ($contact['gender']) {
                case 1:
                    $gender = "男性";
                    break;
                case 2:
                    $gender = "女性";
                    break;
                case 3:
                    $gender = "その他";
                    break;
            }

            $csvData[ $data_id ]= array(
                $contact['id'],
                $contact['last_name'],
                $contact['first_name'],
                $gender,
                $contact['email'],
                $contact['tel'],
                $contact['address'],
                $contact['building'],
                $category_list[ $contact['category_id'] ],
                $contact['detail'],
                $contact['created_at'],
                $contact['updated_at'],
            );

        }

// echo '<br /><br />csvData = ';
// var_dump($csvData);
// exit;


        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);

        return $response;
    }
}
