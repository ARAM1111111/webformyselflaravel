<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Portfolio;
use DB;
use Validator;
class PortfolioEditController extends Controller
{
    public function execute(Portfolio $portfolio,Request $request)
    {
    	$filter = DB::table('portfolios')->distinct()->lists('filter');

    	if($request->isMethod('delete')){
    		$portfolio->delete();
    		return redirect('admin')->with('status',"PORTFOLIO DELETED");
    	}

    	if($request->isMethod('post')){
    		$input = $request->except('_token');
    		$input['filter'] = $filter[$input['filter']];

    		$validator = Validator::make($input,[
    				'name'=>'required|max:100',
    				'filter'=>'exists:portfolios,filter',
    			]);
    		if($validator->fails()){
    			return redirect()->route('portfolioEdit',['portfolio'=>$input['id']])->withErrors($validator)->withInput();
    		}

    		if($request->hasFile('images')){
    			$file = $request->file('images');
    			$input['images']=$file->getClientOriginalName();
    			$file->move(public_path()."/assets/img",$input['images']);
    		}else{
    			$input['images'] = $input['old_images'];
    		}
    		unset($input['old_images']);
    		$portfolio->unguard();
    		$portfolio->fill($input);
    		if($portfolio->update()){
    			return redirect('admin')->with('status','PORTFOLIO EDITED');
    		}
    		//dd($input);
    	}


    	if(view()->exists('admin.portfolio_edit')){
    		$old = $portfolio->toArray();
    		$data = [
    			'title'=>'PORTFOLIO EDIT-'.$old['name'],
    			'data'=>$old,
    			'filter'=>$filter,
    			];
    		return view('admin.portfolio_edit',$data);
    	}
    	

    	//dd($old);
    }
}
