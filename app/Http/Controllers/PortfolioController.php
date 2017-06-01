<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Portfolio;
class PortfolioController extends Controller
{
    public function execute(Request $request)
    {
    	if(view()->exists('admin.portfolios')){
    		$portfolios = Portfolio::all();
    		//dd($portfolios);
    		$data = [
    			'title'=>'PORTFOLIOS',
    			'portfolios'=>$portfolios,
    		];

    		return view('admin.portfolios',$data);
    	}
    	abort(404);
    }

}
