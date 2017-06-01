<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Service;
class ServiceAddController extends Controller
{
    public function execute(Request $request)
    {	
    	if($request->isMethod('post')){
    		$input = $request->except('_token');
    		$validator = Validator::make($input,[
    				'name'=>'required|max:100',
    				'icon'=>'required|max:30',
    				'text'=>'required',
    			]);
    		if($validator->fails()){
    			return redirect()->route('serviceAdd')->withErrors($validator)->withInput();
    		}

    		$service = new Service();
    		$service->unguard();
    		$service->fill($input);
    		if($service->save()){
    			return redirect('admin')->with('status','SERVICE ADDED');
    		}
    	}

    	if(view()->exists('admin.services_add')){
    		return view('admin.services_add',['title'=>'ADD NEW SERVICE']);
    	}
    	abort(404);
    }
}
