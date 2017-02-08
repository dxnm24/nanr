<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Config;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CommonMethod;
use Cache;

class ConfigController extends Controller
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
    public function index()
    {
        //
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
    public function edit($id=1)
    {
        $data = Config::find($id);
        return view('admin.config.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=1)
    {
        trimRequest($request);
        $data = Config::find($id);
        $rules = [
            'meta_title' => 'max:255',
            'meta_keyword' => 'max:255',
            'meta_description' => 'max:255',
            'meta_image' => 'max:255',
            'facebook_app_id' => 'max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data->update([
                'code' => $request->code,
                'meta_title' => $request->meta_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'meta_image' => CommonMethod::removeDomainUrl($request->meta_image),
                'facebook_app_id' => $request->facebook_app_id,
                'credit' => $request->credit,
                // 'status' => $request->status,
                // 'lang' => $request->lang,
            ]);
        Cache::flush();
        return redirect()->route('admin.config.edit', $id)->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
