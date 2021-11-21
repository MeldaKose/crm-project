<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        $inputSearch = $_GET['q'];
        $contacts = Contact::where('first_name', 'LIKE', '%' . $inputSearch . '%')
            ->orWhere('last_name', 'LIKE', '%' . $inputSearch . '%')
            ->get();
        $veriler=array();
        foreach ($contacts as $contact) {
           $veriler[]=array('first_name'=>$contact->first_name,'last_name'=>$contact->last_name);
        }
        return json_encode($veriler);
    }
}
