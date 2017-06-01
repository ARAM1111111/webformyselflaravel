<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use DB;
use App\Portfolio;
class PortfolioAddController extends Controller
{
    public function execute(Request $request)
    {
    	//$filter = DB::table('portfolios')->distinct()->lists('filter');
    	if($request->isMethod('post')){
    		$input = $request->except('_token');
    		//$filter_name = $filter[$input['filter']];
    		//$input['filter'] = $filter_name;
    		//dd($input);
    		$validator = Validator::make($input,[
    				'name'=>'required|min:1',
    				'images'=>'required',
    				'filter'=>'required|unique:portfolios',
    			]);
    		if($validator->fails()){
    			return redirect()->route('portfolioAdd')->withErrors($validator)->withInput();
    		}
    	

    	if($request->hasFile('images')){
    		$file = $request->file('images');	
    		$input['images'] = $file->getClientOriginalName();
    		//dd($input['images']);
    		$file->move(public_path().'/assets/img',$input['images']);
    	}

    	$portfolio = new Portfolio();
    	$portfolio->unguard();
    	$portfolio->fill($input);

    	if($portfolio->save($input)){

    		return redirect('admin')->with('status','PORTFOLIO ADDED');
    	}


    }
    	if(view()->exists('admin.portfolio_add')){
    		
    		$data = ['title'=>'ADD PORTFOLIO'];

    		return view('admin.portfolio_add',$data);
    	}
    	abort(404);

    }
}
