<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service;
use Validator;
class ServiceEditController extends Controller
{
    public function execute(Service $service,Request $request)
    {
    	if($request->isMethod('delete')){
    		$service->delete();
    		return redirect('admin')->with('status','PAGE DELETED');
    	}

    	if($request->isMethod('post')){
    		$input = $request->except('_token');
    		//dd($input);
    		$validator = Validator::make($input,[
    				'name'=>'required|max:100',
    				'icon'=>'required|max:100',
    				'text'=>'required'
    			]);
    		if($validator->fails()){
    			return redirect()->route('serviceEdit',['service'=>$input['id']])->withErrors($validator);
    		}

    		$service->unguard();
    		$service->fill($input);
    		if($service->update()){
    			return redirect('admin')->with('status','PAGE EDITED');
    		}
    	}

    	if(view()->exists('admin.service_edit')){
    		$old = $service->toArray();
    		
    		$data = ['title'=>'EDIT PAGE-'.$old['id'],'data'=>$old];
    		return view('admin.service_edit',$data);
    	}
    }
}
