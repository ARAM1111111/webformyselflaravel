<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//-----------------------------HOME(index)----------------------------------------
Route::group([],function(){
	Route::match(['get','post'],'/','IndexController@execute')->name('home');
	Route::get('/page/{alias}','PageController@execute')->name('page');

	Route::auth();

});

//-------------------------------admin------------------------------------------

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
	Route::get('/',function(){
		if(view()->exists('admin.index')){
			$data = ['title'=>'ADMINISTRATOR PANEL'];
			return view('admin.index',$data);
		}
	});
//admin/pages
	Route::group(['prefix'=>'pages'],function(){
		Route::get('/','PagesController@execute')->name('pages');
//admin/pages/add
		Route::match(['get','post'],'/add','PagesAddController@execute')->name('pagesAdd');

		Route::match(['get','post','delete'],'/edit/{page}','PagesEditController@execute')->name('pagesEdit');
	});
//----------------------------portfolios-----------------------------------------

Route::group(['prefix'=>'portfolios'],function(){
		Route::get('/','PortfolioController@execute')->name('portfolio');

		Route::match(['get','post'],'/add','PortfolioAddController@execute')->name('portfolioAdd');

		Route::match(['get','post','delete'],'/edit/{portfolio}','PortfolioEditController@execute')->name('portfolioEdit');
	});
//-----------------------------services---------------------------------------------

Route::group(['prefix'=>'services'],function(){
		Route::get('/','ServiceController@execute')->name('services');

		Route::match(['get','post'],'/add','ServiceAddController@execute')->name('serviceAdd');

		Route::match(['get','post','delete'],'/edit/{service}','ServiceEditController@execute')->name('serviceEdit');
	});

});

Route::auth();

Route::get('/home', 'HomeController@index');
