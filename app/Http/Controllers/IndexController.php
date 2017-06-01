<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Page;
use App\Service;
use App\People;
use App\Portfolio;
use DB;
use Mail;

class IndexController extends Controller
{
    public function execute(Request $request)
    {

    	if($request->isMethod('post')){

    		$messages = [
    			'required'=>'FIELD :attribute MUST BE COMPLETED',
    			'email' =>'FIELD :attribute MUST BE VALID EMAIL',

    		];

    		$this->validate($request,[
    			'name'=>'required|max:255',
    			'email'=>'required|email',
    			'text'=>'required|min:10'
    		],$messages);
    		// dump($request);
    		$data = $request->all();

    		$res = Mail::send('site.emeil',['data'=>$data],function($m)use ($data){
    			$mail_admin = env('MAIL_ADMIN');
    			$m->from($data['email'],$data['name']);
    			$m->to($mail_admin)->subject('QUESTION');
    		});

    		if($res){
    			return redirect()->route('home')->with('status','EMEIL SENDED');
    		}
    	}



    	$pages = Page::all();
    	$portfolios = Portfolio::get(array('name','filter','images'));
    	$services = Service::all();
    	$peoples = People::take(3)->get();
    	//$tags = DB::select('SELECT DISTINCT filter FROM `portfolios` ');
    	$tags = DB::table('portfolios')->distinct()->lists('filter');
    	//dd($tabs);
    	
    	$menu=array();
    	foreach ($pages as $page) {
    		$item = array('title'=>$page->name,'alias'=>$page->alias);
    		array_push($menu, $item );
    	}

    	$item = array('title'=>'Services','alias'=>'service');
    	array_push($menu, $item);

    	$item = array('title'=>'Portfolio','alias'=>'Portfolio');
    	array_push($menu, $item);

    	$item = array('title'=>'Team','alias'=>'team');
    	array_push($menu, $item);

    	$item = array('title'=>'Contact','alias'=>'contact');
    	array_push($menu, $item);

    	 // dd($menu);
    	return view('site.index',array(
    			'menu'=>$menu,
    			'pages'=>$pages,
    			'services'=>$services,
    			'portfolios'=>$portfolios,
    			'peoples'=>$peoples,
    			'tags'=>$tags
    		));
    }
}
