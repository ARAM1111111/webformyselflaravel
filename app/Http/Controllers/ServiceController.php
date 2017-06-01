<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service;
class ServiceController extends Controller
{
    public function execute(Request $request)
    {
    	if(view()->exists('admin.services')){
    		$services = Service::all();
    		$data = [
    			'title'=>'SERVICES',
    			'services'=>$services
    			];
    		return view('admin.services',$data);
    	}
    }
}
