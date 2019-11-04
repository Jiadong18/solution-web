<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Travellers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;


class TravellersController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();
	public $module = 'travellers';
	static $per_page	= '100000';

	public function __construct()
	{

		$this->model = new Travellers();

		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);

		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'travellers',
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

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'travellerID');
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
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
		$pagination->setPath('travellers');

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
		return view('travellers.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('travellers');
		}
		$this->data['fields'] =  \App\Library\AjaxHelpers::fieldLang($this->info['config']['forms']);

		$this->data['id'] = $id;
		return view('travellers.form',$this->data);
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

        $bookingdetail 		=  \DB::table('bookings')->where('travellerID',$id)->orderBy('bookingsID','ASC')->get();
		$book = array();
		$first = 0;
		foreach($bookingdetail as $bd)
		{
			$book[] = array(
				'bookingsID'	        =>$bd->bookingsID ,
				'bookingno'	            =>$bd->bookingno     ,
				'travellerID'	        =>$bd->travellerID,
				'tour'		            =>$bd->tour,
				'hotel'	          	    =>$bd->hotel,
				'flight'	            =>$bd->flight,
				'car'  		            =>$bd->car,
				'extraservices'     	=>$bd->extraservices,
				'updated_at'            =>$bd->updated_at,
				'created_at'	       	=>$bd->created_at,
				'entry_by'	          	=>$bd->entry_by
			);
			++$first;
		}
		$this->data['book']  = $book;

        $payments 		=  \DB::table('invoice_payments')->where('travellerID',$id)->orderBy('payment_date','ASC')->get();
		$pay = array();
		$second = 0;
		foreach($payments as $pt)
		{
			$pay[] = array(
				'invoicePaymentID'	=>$pt->invoicePaymentID ,
				'travellerID'	    =>$pt->travellerID,
				'invoiceID'	      	=>$pt->invoiceID,
				'amount'	        =>$pt->amount,
				'currency'	        =>$pt->currency,
				'payment_type'      =>$pt->payment_type,
				'payment_date'    	=>$pt->payment_date,
				'notes'	            =>$pt->notes,
				'updated_at'        =>$pt->updated_at,
				'created_at'    	=>$pt->created_at,
				'entry_by'	       	=>$pt->entry_by
			);
			++$second;
		}
		$this->data['pay']  = $pay;


        $travellersnotes 		=  \DB::table('travellers_note')->where('travellerID',$id)->orderBy('created_at','ASC')->get();
		$tnotes = array();
		$third = 0;
		foreach($travellersnotes as $tn)
		{
			$tnotes[] = array(
				'travellers_noteID'	=>$tn->travellers_noteID ,
				'travellerID'	    =>$tn->travellerID,
				'title'	            =>$tn->title,
				'note'	            =>$tn->note,
				'style'	            =>$tn->style,
				'updated_at'        =>$tn->updated_at,
				'created_at'    	=>$tn->created_at,
				'entry_by'	       	=>$tn->entry_by
			);
			++$third;
		}
		$this->data['tnotes']  = $tnotes;

        $invoices 		=\DB::table('invoice')->where('travellerID',$id)->orderBy('DateIssued','ASC')->get();
		$invo = array();
		$fourth = 0;
		foreach($invoices as $in)
		{
			$invo[] = array(
				'invoiceID'	        =>$in->invoiceID ,
				'status'	        =>$in->status,
				'travellerID'	    =>$in->travellerID,
				'bookingID'	        =>$in->bookingID,
				'InvTotal'	        =>$in->InvTotal,
				'currency'	        =>$in->currency,
				'DateIssued'        =>$in->DateIssued,
				'DueDate'       	=>$in->DueDate
			);
			++$fourth;
		}
		$this->data['invo']  = $invo;


        $files 		=\DB::table('travellers_files')->where('travellerID',$id)->orderBy('fileID','ASC')->get();
		$file = array();
		$fifth = 0;
		foreach($files as $fl)
		{
			$file[] = array(
				'fileID'	        =>$fl->fileID ,
				'travellerID'	    =>$fl->travellerID ,
				'file_type'	        =>$fl->file_type,
				'file'	            =>$fl->file,
				'remarks'	        =>$fl->remarks,
				'created_at'	    =>$fl->created_at,
				'updated_at'	    =>$fl->updated_at
            );
			++$fifth;
		}
		$this->data['file']  = $file;

            return view('travellers.view',$this->data);
		} else {
			return Redirect::to('travellers')->with('messagetext',\Lang::get('core.norecord'))->with('msgstatus','error');
		}

	}

	function postCopy( Request $request)
	{
	    foreach(\DB::select("SHOW COLUMNS FROM travellers ") as $column)
        {
			if( $column->Field != 'travellerID')
				$columns[] = $column->Field;
        }

		if(count($request->input('ids')) >=1)
		{
			$toCopy = implode(",",$request->input('ids'));
			$sql = "INSERT INTO travellers (".implode(",", $columns).") ";
			$sql .= " SELECT ".implode(",", $columns)." FROM travellers WHERE travellerID IN (".$toCopy.")";
			\DB::insert($sql);
			return Redirect::to('travellers')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		} else {

			return Redirect::to('travellers')->with('messagetext',\Lang::get('core.note_selectrow'))->with('msgstatus','error');
		}

	}

	function postSave( Request $request)
	{

		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$data = $this->validatePost('tb_travellers');

			$id = $this->model->insertRow($data , $request->input('travellerID'));

			if(!is_null($request->input('apply')))
			{
				$return = 'travellers/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'travellers?return='.self::returnUrl();
			}

			// Insert logs into database
			if($request->input('travellerID') =='')
			{
				\App\Library\SiteHelpers::auditTrail( $request , 'New Data with ID '.$id.' Has been Inserted !');
			} else {
				\App\Library\SiteHelpers::auditTrail($request ,'Data with ID '.$id.' Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');

		} else {

			return Redirect::to('travellers/update/'. $request->input('travellerID'))->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('travellers')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success');

		} else {
			return Redirect::to('travellers')
        		->with('messagetext',\Lang::get('core.note_noitemdeleted'))->with('msgstatus','error');
		}

	}

	public static function display( )
	{
		$mode  = isset($_GET['view']) ? 'view' : 'default' ;
		$model  = new Travellers();
		$info = $model::makeInfo('travellers');

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
				return view('travellers.public.view',$data);
			}

		} else {

			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$params = array(
				'page'		=> $page ,
				'limit'		=>  (isset($_GET['rows']) ? filter_var($_GET['rows'],FILTER_VALIDATE_INT) : 10 ) ,
				'sort'		=> 'travellerID' ,
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
			return view('travellers.public.index',$data);
		}


	}

	function postSavepublic( Request $request)
	{

		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$data = $this->validatePost('travellers');
			 $this->model->insertRow($data , $request->input('travellerID'));
			return  Redirect::back()->with('messagetext','<p class="alert alert-success">'.\Lang::get('core.note_success').'</p>')->with('msgstatus','success');
		} else {

			return  Redirect::back()->with('messagetext','<p class="alert alert-danger">'.\Lang::get('core.note_error').'</p>')->with('msgstatus','error')
			->withErrors($validator)->withInput();

		}

	}

	public function getNotedelete( Request $request , $travellerID ,  $travellers_noteID=0)
	{
		\DB::table('travellers_note')->where('travellers_noteID',$travellers_noteID)->delete();
			return Redirect::to('travellers/show/'.$travellerID)
	        	->with('messagetext','Note has been deleted !')->with('msgstatus','success');
	}

	public function getFiledelete( Request $request , $travellerID ,  $fileID=0)
	{
		\DB::table('travellers_files')->where('fileID',$fileID)->delete();
			return Redirect::to('travellers/show/'.$travellerID)
	        	->with('messagetext','File has been deleted !')->with('msgstatus','success');
	}





}
