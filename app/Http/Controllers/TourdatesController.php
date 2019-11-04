<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Tourdates;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;
use SiteHelpers;
use Carbon\Carbon;



class TourdatesController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();
	public $module = 'tourdates';
	static $per_page	= '100000';

	public function __construct()
	{

		$this->model = new Tourdates();

		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);

		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'tourdates',
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

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'tourdateID');
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

        $today = date("Y-m-d");
        $running_tours = \DB::table('tour_date')
                ->where('start','<=',$today)
                ->where('end','>=',$today)
                ->where('status',1)
                ->count();
        $upcoming_tours = \DB::table('tour_date')
                ->where('start','>',$today)
                ->where('status',1)
                ->count();
        $old_tours = \DB::table('tour_date')
                ->where('end','<',$today)
                ->where('status',1)
                ->count();
        $cancelled_tours = \DB::table('tour_date')
                ->where('status',2)
                ->count();

		$page = $request->input('page', 1);
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null($request->input('rows')) ? filter_var($request->input('rows'),FILTER_VALIDATE_INT) : static::$per_page ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$results = $this->model->getRows( $params );

		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
		$pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
		$pagination->setPath('tourdates');
        $this->data['running_tours']        = $running_tours;
		$this->data['upcoming_tours']       = $upcoming_tours;
		$this->data['old_tours']            = $old_tours;
		$this->data['cancelled_tours']      = $cancelled_tours;
		$this->data['today']                 = $today;

		$this->data['rowData']		= $results['rows'];
		$this->data['pagination']	= $pagination;
		$this->data['pager'] 		= $this->injectPaginate();
		$this->data['i']			= ($page * $params['limit'])- $params['limit'];
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['colspan'] 		= \App\Library\SiteHelpers::viewColSpan($this->info['config']['grid']);
		$this->data['access']		= $this->access;
		$this->data['fields'] =  \App\Library\AjaxHelpers::fieldLang($this->info['config']['grid']);
		$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
		return view('tourdates.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tour_date');
		}
		$this->data['fields'] =  \App\Library\AjaxHelpers::fieldLang($this->info['config']['forms']);

		$this->data['id'] = $id;
		return view('tourdates.form',$this->data);
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

        $bookinglist = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('book_room.status','=',1)
            ->orderBy('roomtype','ASC')
            ->get();

		$bkList = array();
		$first = 0;
		foreach($bookinglist as $bl)
		{
			$bkList[] = array(
				'travellers'	    =>$bl->travellers ,
				'remarks'	        =>$bl->remarks ,
			);
			++$first;
		}
		$this->data['bkList']  = $bkList;


        $room_single = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype','=',1)
            ->where('book_room.status','=',1)
            ->count();

        $room_double = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype','=',2)
            ->where('book_room.status','=',1)
            ->count();

        $room_triple = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype','=',3)
            ->where('book_room.status','=',1)
            ->count();
        $total= $room_single+($room_double*2)+($room_triple*3) ;


		$this->data['room_single']          = $room_single;
		$this->data['room_double']          = $room_double;
		$this->data['room_triple']          = $room_triple;
		$this->data['total']                = $total;

             if(!is_null($request->input('bookinglist')))
			{
				$html = view('tourdates.pdfbookinglist', $this->data)->render();
				return \PDF::load($html)->filename('BookingList-'.$id.'.pdf')->show();
			}

             if(!is_null($request->input('passportlist')))
			{
				$html = view('tourdates.pdfpassportlist', $this->data)->render();
				return \PDF::load($html)->filename('PassportList-'.$id.'.pdf')->show();
			}

             if(!is_null($request->input('emergencylist')))
			{
				$html = view('tourdates.pdfemergencylist', $this->data)->render();
				return \PDF::load($html, $size = 'A4', $orientation = 'landscape')->filename('PassportList-'.$id.'.pdf')->show();
			}


            return view('tourdates.view',$this->data);

		} else {
			return Redirect::to('tourdates')->with('messagetext',\Lang::get('core.norecord'))->with('msgstatus','error');
		}
	}

	function postCopy( Request $request)
	{
	    foreach(\DB::select("SHOW COLUMNS FROM tour_date ") as $column)
        {
			if( $column->Field != 'tourdateID')
				$columns[] = $column->Field;
        }

		if(count($request->input('ids')) >=1)
		{
			$toCopy = implode(",",$request->input('ids'));
			$sql = "INSERT INTO tour_date (".implode(",", $columns).") ";
			$sql .= " SELECT ".implode(",", $columns)." FROM tour_date WHERE tourdateID IN (".$toCopy.")";
			\DB::insert($sql);
			return Redirect::to('tourdates')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		} else {

			return Redirect::to('tourdates')->with('messagetext',\Lang::get('core.note_selectrow'))->with('msgstatus','error');
		}

	}

	function postSave( Request $request)
	{

		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$data = $this->validatePost('tb_tourdates');

			$id = $this->model->insertRow($data , $request->input('tourdateID'));

			if(!is_null($request->input('apply')))
			{
				$return = 'tourdates/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'tourdates?return='.self::returnUrl();
			}

			// Insert logs into database
			if($request->input('tourdateID') =='')
			{
				\App\Library\SiteHelpers::auditTrail( $request , 'New Data with ID '.$id.' Has been Inserted !');
			} else {
				\App\Library\SiteHelpers::auditTrail($request ,'Data with ID '.$id.' Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');

		} else {

			return Redirect::to('tourdates/update/'. $request->input('tourdateID'))->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('tourdates')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success');

		} else {
			return Redirect::to('tourdates')
        		->with('messagetext',\Lang::get('core.note_noitemdeleted'))->with('msgstatus','error');
		}

	}

	public static function display( )
	{
		$mode  = isset($_GET['view']) ? 'view' : 'default' ;
		$model  = new Tourdates();
		$info = $model::makeInfo('tourdates');

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
				return view('tourdates.public.view',$data);
			}

		} else {

			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$params = array(
				'page'		=> $page ,
				'limit'		=>  (isset($_GET['rows']) ? filter_var($_GET['rows'],FILTER_VALIDATE_INT) : 10 ) ,
				'sort'		=> 'tourdateID' ,
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
			return view('tourdates.public.index',$data);
		}


	}

	function postSavepublic( Request $request)
	{

		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$data = $this->validatePost('tour_date');
			 $this->model->insertRow($data , $request->input('tourdateID'));
			return  Redirect::back()->with('messagetext','<p class="alert alert-success">'.\Lang::get('core.note_success').'</p>')->with('msgstatus','success');
		} else {

			return  Redirect::back()->with('messagetext','<p class="alert alert-danger">'.\Lang::get('core.note_error').'</p>')->with('msgstatus','error')
			->withErrors($validator)->withInput();

		}

	}

    static public function travelersDetail( $traveler = '')
	{
		$travelersDetail='';
		if($traveler !='')
		{
			$sqltrv = \DB::table('travellers')->whereIn('travellerID',explode(',',$traveler))->get();

            foreach ($sqltrv as $v2) {

				$travelersDetail .= "<div class='col-md-6'><a href='".url('travellers/show')."/".$v2->travellerID."'>".$v2->nameandsurname."</a></div><div class='col-md-2'>".SiteHelpers::formatLookUp($v2->countryID,'countryID','1:def_country:countryID:country_code')."</div>
 ";
			}
		}
		return $travelersDetail;
	}


    static public function travelersDetailpdf( $traveler = '')
	{
		$travelersDetail='';
		if($traveler !='')
		{
			$sqltrv = \DB::table('travellers')->whereIn('travellerID',explode(',',$traveler))->get();

            foreach ($sqltrv as $v2) {

				$travelersDetail .= "<tr><td style='border:0px;'> ".$v2->nameandsurname."</td><td style='width:5%;'> ".SiteHelpers::formatLookUp($v2->countryID,'countryID','1:def_country:countryID:country_code')."</td></tr>";
			}
		}
		return $travelersDetail;
	}

    static public function travelersDetailpassport( $travelerpass = '')
	{
		$travelersDetailpassport='';
		if($travelerpass !='')
		{
			$sqltrvpass = \DB::table('travellers')->whereIn('travellerID',explode(',',$travelerpass))->get();

            foreach ($sqltrvpass as $v3) {

				$travelersDetailpassport .= "<tr>
                <td style='width:20%'> ".$v3->nameandsurname."</td>
                <td style='width:15%'> ".$v3->passportno."</td>
                <td style='width:20%'> ".SiteHelpers::formatLookUp($v3->passportcountry,'countryID','1:def_country:countryID:country_name')."</td>
                <td style='width:15%'> ".SiteHelpers::TarihFormat($v3->dateofbirth)."</td>
                <td style='width:15%'> ".SiteHelpers::TarihFormat($v3->passportissue)."</td>
                <td style='width:15%'> ".SiteHelpers::TarihFormat($v3->passportexpiry)."</td>
                </tr>";
			}
		}
		return $travelersDetailpassport;
	}


    static public function travelersDetailemergency( $traveleremr = '')
	{
		$travelersDetailemergency='';
		if($traveleremr !='')
		{
			$sqltrvemr = \DB::table('travellers')->whereIn('travellerID',explode(',',$traveleremr))->get();

            foreach ($sqltrvemr as $v4) {

				$travelersDetailemergency .= "<tr>
                <td> ".$v4->nameandsurname."</td>
                <td> ".$v4->emergencycontactname."</td>
                <td> ".$v4->emergencycontactemail."</td>
                <td> ".$v4->emergencycontanphone."</td>
                <td> ".$v4->insurancecompany."</td>
                <td> ".$v4->insurancepolicyno."</td>
                <td> ".$v4->insurancecompanyphone."</td>
                <td> ".$v4->bedconfiguration."</td>
                <td> ".$v4->dietaryrequirements."</td>
                </tr>";
			}
		}
		return $travelersDetailemergency;
	}



}
