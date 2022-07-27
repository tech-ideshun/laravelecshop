<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::where('status', '=', 1)->orderBy('created_at', 'asc')
                    ->paginate(3);
        
                    return view('contacts.index', [
                            'contacts' => $contacts,
                        ]);
    }

    public function index2(Request $request)
    {
        $contacts2 = Contact::where('status', '=', 2)->orderBy('created_at', 'desc')
                    ->paginate(3);

                    return view('contacts.index2', [
                        'contacts2' => $contacts2,
                    ]);
    }

    public function add(Request $request)
    {
        return view('contacts.add');
    }

    
    public function create(Request $request)
    {


        $this->validate($request, Contact::$rules);

        $contact = new Contact;
        $contact->title = $request->title;
        $contact->user_id = Auth::id(); //追加
        $contact->content = $request->content;
        $contact->status = 1;
        $contact->save();

        // return redirect('/add');
        return view('contacts.contact-complete');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        $contact = Contact::find($request->contact_id)->update(['status' => 2]);
        return redirect('/contact');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_o
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
