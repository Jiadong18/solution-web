<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Createbooking;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;


class CreatebookingController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();
	public $module = 'createbooking';
	static $per_page	= '100000';

	public function __construct()
	{

		$this->model = new Createbooking();

		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);

		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'createbooking',
			'return'	=> self::returnUrl()

		);

		\App::setLocale(CNF_LANG);
		if (defined('CNF_MULTILANG') && CNF_MULTILANG == '1') {

		$lang = (\Session::get('lang') != "" ? \Session::get('lang') : CNF_LANG);
		\App::setLocale($lang);
		}



	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0)
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'bookingsID');
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'desc');
		// End Filter sort and order for query
		// Filter Search for query
		$filter = '';
		if(!is_null($request->input('search')))
		{
			$search = 	$this->buildSearch('maps');
			$filter = $search['param'];
			$this->data['search_map'] = $search['maps'];
		}


		$page = $request->input('page', 1);
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null($request->input('rows')) ? filter_var($request->input('rows'),FILTER_VALIDATE_INT) : static::$per_page ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query
		$results = $this->model->getRows( $params );

		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
		$pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
		$pagination->setPath('createbooking');

		$this->data['rowData']		= $results['rows'];
		// Build Pagination
		$this->data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$this->data['pager'] 		= $this->injectPaginate();
		// Row grid Number
		$this->data['i']			= ($page * $params['limit'])- $params['limit'];
		// Grid Configuration
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['colspan'] 		= \App\Library\SiteHelpers::viewColSpan($this->info['config']['grid']);
		// Group users permission
		$this->data['access']		= $this->access;
		// Detail from master if any
		$this->data['fields'] =  \App\Library\AjaxHelpers::fieldLang($this->info['config']['grid']);
		// Master detail link if any
		$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
		// Render into template
		return view('createbooking.index',$this->data);
	}



	function getUpdate(Request $request, $id = null)
	{

		if($id =='')
		{
			if($this->access['is_add'] ==0 )
			return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}

		if($id !='')
		{
			if($this->access['is_edit'] ==0 )
			return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}

		$row = $this->model->find($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('bookings');
		}
		$this->data['fields'] =  \App\Library\AjaxHelpers::fieldLang($this->info['config']['forms']);

		$this->data['id'] = $id;
		return view('createbooking.form',$this->data);
	}

	public function getShow( Request $request, $id = null)
	{

		if($this->access['is_detail'] ==0)
		return Redirect::to('dashboard')
			->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
			$this->data['fields'] 		=  \App\Library\SiteHelpers::fieldLang($this->info['config']['grid']);
			$this->data['id'] = $id;
			$this->data['access']		= $this->access;
			$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
			$this->data['fields'] =  \App\Library\AjaxHelpers::fieldLang($this->info['config']['grid']);
			$this->data['prevnext'] = $this->model->prevNext($id);


        $tours 		=  \DB::table('book_tour')->where('bookingID',$id)->orderBy('status','desc')->get();
		$trs = array();
		$first = 0;
		foreach($tours as $ts)
		{
			$trs[] = array(
				'booktourID'	       =>$ts->booktourID ,
				'bookingID'	           =>$ts->bookingID,
				'tourcategoriesID'	   =>$ts->tourcategoriesID,
				'tourID'	           =>$ts->tourID,
				'tourdateID'	       =>$ts->tourdateID,
				'updated_at'           =>$ts->updated_at,
				'created_at'    	   =>$ts->created_at,
				'entry_by'	       	   =>$ts->entry_by,
				'status'	       	   =>$ts->status
			);
			++$first;
		}
		$this->data['trs']  = $trs;

        $rooms 		=  \DB::table('book_room')->where('bookingID',$id)->orderBy('status','desc')->get();
		$rms = array();
		$second = 0;
		foreach($rooms as $rs)
		{
			$rms[] = array(
				'roomID'	           =>$rs->roomID ,
				'bookingID'	           =>$rs->bookingID,
				'roomtype'	           =>$rs->roomtype,
				'travellers'	       =>$rs->travellers,
				'updated_at'           =>$rs->updated_at,
				'created_at'    	   =>$rs->created_at,
				'entry_by'	       	   =>$rs->entry_by,
				'status'	       	   =>$rs->status
			);
			++$second;
		}
		$this->data['rms']  = $rms;


        $hotels 		=  \DB::table('book_hotel')->where('bookingID',$id)->orderBy('status','desc')->get();
		$hotel = array();
		$third = 0;
		foreach($hotels as $hot)
		{
			$hotel[] = array(
				'bookhotelID'	       =>$hot->bookhotelID ,
				'bookingID'	           =>$hot->bookingID,
				'countryID'	           =>$hot->countryID,
				'cityID'	           =>$hot->cityID,
				'hotelID'	           =>$hot->hotelID,
				'checkin'	           =>$hot->checkin,
				'checkout'	           =>$hot->checkout,
				'updated_at'           =>$hot->updated_at,
				'created_at'    	   =>$hot->created_at,
				'status'    	       =>$hot->status
			);
			++$third;
		}
		$this->data['hotel']  = $hotel;


        $flights 		=  \DB::table('book_flight')->where('bookingID',$id)->orderBy('status','desc')->get();
		$flight = array();
		$fourth = 0;
		foreach($flights as $fl)
		{
			$flight[] = array(
				'bookflightID'	       =>$fl->bookflightID ,
				'bookingID'	           =>$fl->bookingID,
				'travellersID'	       =>$fl->travellersID,
				'airlineID'	           =>$fl->airlineID,
				'class'	               =>$fl->class,
				'return'	           =>$fl->return,
				'depairportID'	       =>$fl->depairportID,
				'arrairportID'         =>$fl->arrairportID,
				'departing'	           =>$fl->departing,
				'returning'	           =>$fl->returning,
				'updated_at'           =>$fl->updated_at,
				'created_at'    	   =>$fl->created_at,
				'status'    	       =>$fl->status
			);
			++$fourth;
		}
		$this->data['flight']  = $flight;


        $cars 		=  \DB::table('book_car')->where('bookingID',$id)->orderBy('status','desc')->get();
		$car = array();
		$fifth = 0;
		foreach($cars as $cr)
		{
			$car[] = array(
				'bookcarID'	       =>$cr->bookcarID ,
				'bookingID'	       =>$cr->bookingID,
				'carbrandID'	   =>$cr->carbrandID,
				'carsID'	       =>$cr->carsID,
				'start'	           =>$cr->start,
				'end'	           =>$cr->end,
				'pickup'	       =>$cr->pickup,
				'dropoff'	       =>$cr->dropoff,
				'updated_at'       =>$cr->updated_at,
				'created_at'       =>$cr->created_at,
				'status'    	   =>$cr->status
			);
			++$fifth;
		}
		$this->data['car']  = $car;


        $extras 		=  \DB::table('book_extra')->where('bookingID',$id)->orderBy('status','desc')->get();
		$extra = array();
		$sixth = 0;
		foreach($extras as $ex)
		{
			$extra[] = array(
				'bookextraID'	   =>$ex->bookextraID ,
				'bookingID'	       =>$ex->bookingID,
				'extraserviceID'   =>$ex->extraserviceID,
				'updated_at'       =>$ex->updated_at,
				'created_at'       =>$ex->created_at,
				'status'    	   =>$ex->status
			);
			++$sixth;
		}
		$this->data['extra']  = $extra;

                     if(!is_null($request->input('pdf')))
			{
				$html = view('createbooking.pdf', $this->data)->render();
				return \PDF::load($html)->filename('Booking-'.$id.'.pdf')->show();
			}



            return view('createbooking.view',$this->data);
		} else {
			return Redirect::to('createbooking')->with('messagetext',\Lang::get('core.norecord'))->with('msgstatus','error');
		}
	}

	function postCopy( Request $request)
	{
	    foreach(\DB::select("SHOW COLUMNS FROM bookings ") as $column)
        {
			if( $column->Field != 'bookingsID')
				$columns[] = $column->Field;
        }

		if(count($request->input('ids')) >=1)
		{
			$toCopy = implode(",",$request->input('ids'));
			$sql = "INSERT INTO bookings (".implode(",", $columns).") ";
			$sql .= " SELECT ".implode(",", $columns)." FROM bookings WHERE bookingsID IN (".$toCopy.")";
			\DB::insert($sql);
			return Redirect::to('createbooking')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		} else {

			return Redirect::to('createbooking')->with('messagetext',\Lang::get('core.note_selectrow'))->with('msgstatus','error');
		}

	}

	function postSave( Request $request)
	{

		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$data = $this->validatePost('tb_createbooking');

			$id = $this->model->insertRow($data , $request->input('bookingsID'));

			if(!is_null($request->input('apply')))
			{
				$return = 'createbooking/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'createbooking/show/'.$id.'?return='.self::returnUrl();
			}

			// Insert logs into database
			if($request->input('bookingsID') =='')
			{
				\App\Library\SiteHelpers::auditTrail( $request , 'New Data with ID '.$id.' Has been Inserted !');
			} else {
				\App\Library\SiteHelpers::auditTrail($request ,'Data with ID '.$id.' Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');

		} else {

			return Redirect::to('createbooking/update/'. $request->input('bookingsID'))->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}

	}

	public function postDelete( Request $request)
	{

		if($this->access['is_remove'] ==0)
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		// delete multipe rows
		if(count($request->input('ids')) >=1)
		{
			$this->model->destroy($request->input('ids'));

			\App\Library\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfully");
			// redirect
			return Redirect::to('createbooking')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success');

		} else {
			return Redirect::to('createbooking')
        		->with('messagetext',\Lang::get('core.note_noitemdeleted'))->with('msgstatus','error');
		}

	}

	public static function display( )
	{
		$mode  = isset($_GET['view']) ? 'view' : 'default' ;
		$model  = new Createbooking();
		$info = $model::makeInfo('createbooking');

		$data = array(
			'pageTitle'	=> 	$info['title'],
			'pageNote'	=>  $info['note']

		);

		if($mode == 'view')
		{
			$id = $_GET['view'];
			$row = $model::getRow($id);
			if($row)
			{
				$data['row'] =  $row;
				$data['fields'] 		=  \App\Library\SiteHelpers::fieldLang($info['config']['grid']);
				$data['id'] = $id;
				return view('createbooking.public.view',$data);
			}

		} else {

			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$params = array(
				'page'		=> $page ,
				'limit'		=>  (isset($_GET['rows']) ? filter_var($_GET['rows'],FILTER_VALIDATE_INT) : 10 ) ,
				'sort'		=> 'bookingsID' ,
				'order'		=> 'asc',
				'params'	=> '',
				'global'	=> 1
			);

			$result = $model::getRows( $params );
			$data['tableGrid'] 	= $info['config']['grid'];
			$data['rowData'] 	= $result['rows'];

			$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
			$pagination = new Paginator($result['rows'], $result['total'], $params['limit']);
			$pagination->setPath('');
			$data['i']			= ($page * $params['limit'])- $params['limit'];
			$data['pagination'] = $pagination;
			return view('createbooking.public.index',$data);
		}


	}

	function postSavepublic( Request $request)
	{

		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$data = $this->validatePost('bookings');
			 $this->model->insertRow($data , $request->input('bookingsID'));
			return  Redirect::back()->with('messagetext','<p class="alert alert-success">'.\Lang::get('core.note_success').'</p>')->with('msgstatus','success');
		} else {

			return  Redirect::back()->with('messagetext','<p class="alert alert-danger">'.\Lang::get('core.note_error').'</p>')->with('msgstatus','error')
			->withErrors($validator)->withInput();

		}

	}




}
