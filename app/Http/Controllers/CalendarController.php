<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;


class CalendarController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();
	public $module = 'calendar';
	static $per_page	= '10';

	public function __construct()
	{

		$this->model = new Calendar();

		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);

		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'calendar',
			'return'	=> self::returnUrl()

		);

	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0)
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		// Group users permission
		$this->data['access']		= $this->access;
		// Detail from master if any

		// Master detail link if any
		$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
		// Render into template
		return view('calendar.index',$this->data);
	}

	function getJsondata( Request $request)
	{
		if (is_null($request->get('start')) || is_null($request->get('end'))) {
			die("Please provide a date range.");
		}

		$results = $this->model->getRows( $params = array() );
		$data = array();
		foreach($results['rows'] as $row)
		{
			$data[] = array(
				'tourdateID'	    => $row->tourdateID,
				'tourcategoriesID'	=> $row->tourcategoriesID,
				'tourID'	        => $row->tourID,
				'tour_code'     	=> $row->tour_code,
				'start'	            => $row->start,
				'title'	            => $row->tour_code,
				'color'	            => $row->color,
				'end'	            => $row->end
			);
		}

		return json_encode($data);
	}


	function getUpdate(Request $request, $tourdateID = null)
	{

		if($tourdateID =='')
		{
			if($this->access['is_add'] ==0 )
			return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}

		if($tourdateID !='')
		{
			if($this->access['is_edit'] ==0 )
			return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}

		$row = $this->model->find($tourdateID);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tour_date');
		}


		$this->data['tourdateID'] = $tourdateID;
		return view('calendar.form',$this->data);
	}

	public function getShow( $tourdateID = null)
	{

		if($this->access['is_detail'] ==0)
			return Redirect::to('dashboard')
				->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');

		$row = $this->model->getRow($tourdateID);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tour_date');
		}

		$this->data['tourdateID'] = $tourdateID;
		$this->data['access']		= $this->access;
		return view('calendar.view',$this->data);
	}

	function postSave( Request $request)
	{

		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$data = $this->validatePost('tour_date');

			$tourdateID = $this->model->insertRow($data , $request->input('tourdateID'));

			if(!is_null($request->input('apply')))
			{
				$return = 'calendar/update/'.$tourdateID.'?return='.self::returnUrl();
			} else {
				$return = 'calendar?return='.self::returnUrl();
			}

			// Insert logs into database
			if($request->input('tourdateID') =='')
			{
				\App\Library\SiteHelpers::auditTrail( $request , 'New Data with ID '.$tourdateID.' Has been Inserted !');
			} else {
				\App\Library\SiteHelpers::auditTrail($request ,'Data with ID '.$tourdateID.' Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');

		} else {

			return Redirect::to('calendar')->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}

	}

	function postSavedrop( Request $request)
	{
		$data = $this->validatePost('tour_date');
		$ID = $this->model->insertRow($data , $request->get('tourdateID'));
		return 'success';

	}

	public function postDelete( Request $request)
	{

		if($this->access['is_remove'] ==0)
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		// delete multipe rows
		if(count($request->input('tourdateID')) >=1)
		{
			$this->model->destroy($request->input('tourdateID'));

			\App\Library\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('tourdateID'))."  , Has Been Removed Successfully");
			// redirect
			return Redirect::to('calendar')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success');

		} else {
			return Redirect::to('calendar')
        		->with('messagetext',\Lang::get('core.note_noitemdeleted'))->with('msgstatus','error');
		}

	}


}
