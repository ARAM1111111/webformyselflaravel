<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Page;
class PagesAddController extends Controller
{
    public function execute(Request $request)
    {
    	if($request->isMethod('post')){
    		// $input = $request->all();return array
    		$input = $request->except('_token');
    		// dd($input);
    		$validator = Validator::make($input,[
    				'name'=>'required|max:50',
    				'alias'=>'required|unique:pages|max:50',
    				'text'=>'required'
    			]);
    		if($validator->fails()){
    			return redirect()->route('pagesAdd')->withErrors($validator)->withInput(); 
    		}

    		if($request->hasFile('images')){
    			$file = $request->file('images');
    			$input['images'] = $file->getClientOriginalName();
    			$file->move(public_path().'/assets/img',$input['images']);
    		}

    		$page = new Page();
    		//$page->unguard() modelum karanq $fillable chlracnenq
    		$page->fill($input);

    		if($page->save($input)){
    			return redirect('admin')->with('status','PAGES ADDED');
    		}
    	}

    	if(view()->exists('admin.pages_add')){
    		$data = [ 'title' => 'NEW PAGE' ];
    		return view('admin.pages_add',$data);
    	}
    	abort(404);
    }
}
