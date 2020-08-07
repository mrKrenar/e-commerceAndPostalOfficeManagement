<?php

namespace App\Http\Controllers;

use App\PostalSetting;
use Illuminate\Http\Request;

class PostalSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = PostalSetting::find(1);
        return view('admin.post_settings')->with('setting', $setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostalSetting $settings)
    {
        // $this->validate($request, [
        //     'transfer_fee' => 'required|number|min:0'
        // ]);

        $data = request()->validate([
            'transfer_fee' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0'
        ]);

        //dd($settings);

        $settings->update($data);

        return redirect('admin/postalsettings')->with('success', 'Changes saved successfully');
    }
}
