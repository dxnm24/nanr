<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    public function __construct()
    {
        if(Auth::guard('admin')->user()->role_id != ADMIN) {
            dd('Permission denied! Please back!');
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        trimRequest($request);
        if($request->except('page')) {
            $data = self::searchPage($request);
        } else {
            $data = Contact::orderBy('id', 'desc')
                        ->paginate(PAGINATION);
        }
        return view('admin.contact.index', ['data' => $data, 'request' => $request]);
    }

    private function searchPage($request)
    {
        $data = DB::table('contacts')->where(function ($query) use ($request) {
            if ($request->name != '') {
                $query = $query->where('name', 'like', '%'.$request->name.'%')
                    ->orWhere('email', 'like', '%'.$request->name.'%')
                    ->orWhere('tel', 'like', '%'.$request->name.'%');
            }
        })
        ->orderBy('id', 'desc')
        ->paginate(PAGINATION);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Contact::find($id);
        $data->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Xóa thành công');
    }

}
