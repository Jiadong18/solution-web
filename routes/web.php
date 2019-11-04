<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



$active_multilang = defined('CNF_MULTILANG') ? CNF_LANG : 'en';
\App::setLocale($active_multilang);
if (defined('CNF_MULTILANG') && CNF_MULTILANG == '1') {

    $lang = (\Session::get('lang') != "" ? \Session::get('lang') : CNF_LANG);
    \App::setLocale($lang);
}


Route::get('/', 'HomeController@index');
AdvancedRoute::controller('home', 'HomeController');
AdvancedRoute::controller('blog', 'PostController');
AdvancedRoute::controller('post', 'PostController');

AdvancedRoute::controller('user', 'UserController');
Route::get('/user/login', 'UserController@getLogin')->name('user.login');



include('pageroutes.php');
include('moduleroutes.php');

Route::get('/restric',function(){

    return view('errors.blocked');

});

AdvancedRoute::controller('mmbapi', 'MmbapiController');
Route::group(['middleware' => 'auth'], function()
{

    Route::get('core/elfinder', 'Core\ElfinderController@getIndex');
    Route::post('core/elfinder', 'Core\ElfinderController@getIndex');
    AdvancedRoute::controller('/dashboard', 'DashboardController');

    AdvancedRoute::controllers([
        'core/users'		=> 'Core\UsersController',
        'notification'		=> 'NotificationController',
        'core/logs'			=> 'Core\LogsController',
        'core/pages' 		=> 'Core\PagesController',
        'core/groups' 		=> 'Core\GroupsController',
        'core/template' 	=> 'Core\TemplateController',
        'core/posts'		=> 'Core\PostsController',
        'core/forms'		=> 'Core\FormsController'
    ]);

});

Route::group(['middleware' => 'auth' , 'middleware'=>'mmbauth'], function()
{

    AdvancedRoute::controllers([
        'core/menu'		    => 'Mmb\MenuController',
        'core/config' 		=> 'Mmb\ConfigController',
        'mmb/module' 		=> 'Mmb\ModuleController',
        'core/tables'		=> 'Mmb\TablesController',
        'core/code'		    => 'Mmb\CodeController',
        'core/rac'			=> 'Mmb\RacController'
    ]);


});
