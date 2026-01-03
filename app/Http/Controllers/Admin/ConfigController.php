<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\Config;
use App\imagetable;
use App\model\Slider;
use Validator;
use Session;

class ConfigController extends Controller
{

    private $messages = [
        'PHONE.required' => ':attribute is required',
        'EMAIL.email' => ':attribute should be in mail format',
        'EMAIL.required' => ':attribute is required',
        'ADDRESS.required' => ':attribute is required',
        'FACEBOOK.url' => ':attribute should in url format',
        // 'FACEBOOK.required' => 'Provide :attribute link',
        'TWITTER.required' => ':attribute Required',
        'TWITTER.url' => ':attribute should in url format',
        'INSTAGRAM.url' => ':attribute should in url format',
        'INSTAGRAM.required' => 'Provide :attribute link',
        'FOOTER_TEXT.required'=> 'Provide :attribute text ',
        'COPYRIGHT.required'=> 'Provide :attribute '
    ];
    private $attributes = [
        'PHONE' => 'Phone Number',
        'EMAIL' => 'Email',
        'ADDRESS' => 'Address ',
        'FACEBOOK' =>'Facebook',
        'TWITTER' =>'Twitter Link',
        'INSTAGRAM' =>'Instagram',
        'FOOTER_TEXT'=>'Footer',
        'COPYRIGHT'=> 'Copyright'

    ];

    public function update(Request $request)
    {
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'ADDRESS' => 'required',
                'EMAIL1' => 'required|email',
                'EMAIL2' => 'required|email',
                'PHONE1' => 'required',
                'PHONE2' => 'required',
                'FOOTER_TEXT' =>'required',
                // 'TAGLINE' =>'required'

            ]);

            if($validator->fails()){
                session::flash('flash_message',$validator->errors()->first());
                return redirect()->back();
            }

            foreach($request->except(['_token']) as $index => $value) {
                $config = Config::where('flag_type', $index)->first();
                $config->flag_value = $value;
                $config->flag_additionalText = $value;
                $config->save();
            }
            session()->flash('message', 'Successfully Updated');
            return redirect('admin/config');
        }
        return view('admin.dashboard.index-config');
    }

}
