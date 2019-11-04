<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Tours;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;
use Dompdf\Dompdf;

class ToursController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();
	public $module = 'tours';
	static $per_page	= '10000';

	public function __construct()
	{

		$this->model = new Tours();

		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);

		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'tours',
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

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'tourID');
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
		// End Filter sort and order for query
		$filter = '';
		if(!is_null($request->input('search')))
		{
			$search = 	$this->buildSearch('maps');
			$filter =   $search['param'];
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
		$pagination->setPath('tours');

		$this->data['rowData']		= $results['rows'];
		$this->data['pagination']	= $pagination;
		$this->data['pager'] 		= $this->injectPaginate();
		$this->data['i']			= ($page * $params['limit'])- $params['limit'];
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


		return view('tours.index',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('tours');
		}
		$this->data['fields'] =  \App\Library\AjaxHelpers::fieldLang($this->info['config']['forms']);

		$this->data['id'] = $id;
		return view('tours.form',$this->data);
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


        $tourdetail 		=  \DB::table('tour_detail')->where('tourID',$id)->orderBy('day','ASC')->get();
		$dayTree = array();
		$first = 0;
		foreach($tourdetail as $td)
		{
			$dayTree[] = array(
				'tourdetailID'	        =>$td->tourdetailID ,
				'title'	                =>$td->title,
				'day'	              	=>$td->day,
				'countryID'		        =>$td->countryID,
				'cityID'		        =>$td->cityID,
				'hotelID'		        =>$td->hotelID,
				'siteID'	          	=>$td->siteID,
				'meal'		            =>$td->meal,
				'optionaltourID'		=>$td->optionaltourID,
				'description'	      	=>$td->description,
				'icon'		            =>$td->icon,
				'image'	            	=>$td->image
			);
			++$first;
		}
		$this->data['dayTree']  = $dayTree;

            if(!is_null($request->input('pdf')))
			{
				$html = view('tours.pdf', $this->data)->render();
				return \PDF::load($html)->filename('Tour-'.$id.'.pdf')->show();
			}

            return view('tours.view',$this->data);
		} else {
			return Redirect::to('tours')->with('messagetext',\Lang::get('core.norecord'))->with('msgstatus','error');
		}
	}

	function postCopy( Request $request)
	{
	    foreach(\DB::select("SHOW COLUMNS FROM tours ") as $column)
        {
			if( $column->Field != 'tourID')
				$columns[] = $column->Field;
        }

		if(count($request->input('ids')) >=1)
		{
			$toCopy = implode(",",$request->input('ids'));
			$sql = "INSERT INTO tours (".implode(",", $columns).") ";
			$sql .= " SELECT ".implode(",", $columns)." FROM tours WHERE tourID IN (".$toCopy.")";
			\DB::insert($sql);
			return Redirect::to('tours')->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
		} else {

			return Redirect::to('tours')->with('messagetext',\Lang::get('core.note_selectrow'))->with('msgstatus','error');
		}

	}

	function postSave( Request $request)
	{

		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$data = $this->validatePost('tb_tours');

			$id = $this->model->insertRow($data , $request->input('tourID'));

			if(!is_null($request->input('apply')))
			{
				$return = 'tours/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'tours?return='.self::returnUrl();
			}

			// Insert logs into database
			if($request->input('tourID') =='')
			{
				\App\Library\SiteHelpers::auditTrail( $request , 'New Data with ID '.$id.' Has been Inserted !');
			} else {
				\App\Library\SiteHelpers::auditTrail($request ,'Data with ID '.$id.' Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');

		} else {

			return Redirect::to('tours/update/'. $request->input('tourID'))->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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
			return Redirect::to('tours')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success');

		} else {
			return Redirect::to('tours')
        		->with('messagetext',\Lang::get('core.note_noitemdeleted'))->with('msgstatus','error');
		}

	}

	public static function display( )
	{
        $tour_list = \DB::table('tours')->get();
        $category= \DB::table('def_tour_categories')
            ->join('tours', 'tours.tourcategoriesID', '=', 'def_tour_categories.tourcategoriesID')
            ->where('tours.status','=','1')
            ->groupBy('def_tour_categories.tourcategoriesID')
            ->get(['def_tour_categories.*', \DB::raw('count(*) as category_count')]);

		$mode  = isset($_GET['view']) ? 'view' : 'default' ;
		$model = new Tours();
		$info  = $model::makeInfo('tours');

		$data = array(
			'pageTitle'	=> 	$info['title'],
			'pageNote'	=>  $info['note']

		);


		if($mode == 'view')
		{
			$id = $_GET['view'];
            \DB::table('tours')->where('tourID',$_GET['view'])->update(array('views'=> \DB::raw('views+1')));

        $tourdetail 		=  \DB::table('tour_detail')->where('tourID',$id)->orderBy('day','ASC')->get();
        $tourdate 		    =  \DB::table('tour_date')->where('tourID',$id)->where('status','1')->orderBy('start','ASC')->get();

		$dayTree = array();
		$first = 0;
		foreach($tourdetail as $td)
		{
			$dayTree[] = array(
				'tourdetailID'	        =>$td->tourdetailID ,
				'title'	                =>$td->title,
				'day'	              	=>$td->day,
				'countryID'		        =>$td->countryID,
				'cityID'		        =>$td->cityID,
				'hotelID'		        =>$td->hotelID,
				'siteID'	          	=>$td->siteID,
				'meal'		            =>$td->meal,
				'optionaltourID'		=>$td->optionaltourID,
				'description'	      	=>$td->description,
				'icon'		            =>$td->icon,
				'image'	            	=>$td->image
			);
			++$first;
		}
		$data['dayTree']  = $dayTree;

		$tdate = array();
		$sec = 0;
		foreach($tourdate as $trd)
		{
			$tdate[] = array(
				'tourdateID'	        =>$trd->tourdateID ,
				'tourID'	            =>$trd->tourID ,
				'tour_code'	            =>$trd->tour_code,
				'start'	              	=>$trd->start,
				'end'		            =>$trd->end,
				'featured'		        =>$trd->featured,
				'definite_departure'    =>$trd->definite_departure,
				'total_capacity'	    =>$trd->total_capacity,
				'cost_single'           =>$trd->cost_single,
				'cost_double'		    =>$trd->cost_double,
				'cost_triple'	      	=>$trd->cost_triple,
				'cost_child'            =>$trd->cost_child,
				'currencyID'	       	=>$trd->currencyID,
				'status'	          	=>$trd->status
			);
			++$sec;
		}
		$data['tdate']  = $tdate;


            $row = $model::getRow($id);
			if($row)
			{
				$data['row'] =  $row;
				$data['fields'] 		=  \App\Library\SiteHelpers::fieldLang($info['config']['grid']);
				$data['id'] = $id;
				return view('tours.public.view',$data);
			}

		} else {

        $sort   = ((isset($_GET['sort']))  ? $_GET['sort'] : 'tourID');
        $order  = ((isset($_GET['order'])) ? $_GET['order'] : 'asc');
		$filter = '';
		if(isset($_GET['search']))
		{
//			$search = $buildSearch('maps');
//			$filter = $search['param'];
//			$data['search_map'] = $search['maps'];
		}


			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$params = array(
				'page'		=> $page ,
				'limit'		=> (isset($_GET['limit'])) ? $_GET['limit'] : '10' ,
				'sort'		=> $sort ,
				'order'		=> $order,
				'params'	=> (isset($_GET['cat']) ? 'AND tourcategoriesID ='.$_GET['cat'] : '' ) ,
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
			$data['category']   = $category;
			$data['tour_list']  = $tour_list;
			return view('tours.public.index',$data);
		}


	}

	function postSavepublic( Request $request)
	{

		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$data = $this->validatePost('tours');
			 $this->model->insertRow($data , $request->input('tourID'));
			return  Redirect::back()->with('messagetext','<p class="alert alert-success">'.\Lang::get('core.note_success').'</p>')->with('msgstatus','success');
		} else {

			return  Redirect::back()->with('messagetext','<p class="alert alert-danger">'.\Lang::get('core.note_error').'</p>')->with('msgstatus','error')
			->withErrors($validator)->withInput();

		}

	}

    public function getTourdetail( Request $request , $tourID , $tourdetailID =0 )
	{
		$rest = \DB::table('tour_detail')->where('tourdetailID',$tourdetailID)->get();
		if(count($rest) >=1)
		{
			$row = $rest[0];
			$this->data['row'] = $row;
		} else {
			$this->data['row'] = (object) array(
				'tourdetailID'	    => '',
				'tourID'		    => $tourID,
				'day'		        => '',
				'countryID'	        => '',
				'cityID'	       	=> '',
                'hotelID'	        => '',
                'siteID'	        => '',
                'meal'	            => '',
                'optionaltourID'    => '',
                'title'	            => '',
                'description'	    => '',
                'icon'	            => '',
                'image'	            => ''
			);
		}
		return view('tours.tourdetail',$this->data);
	}

	public function postTourdetail( Request $request)
	{
		$data =  array(
				'tourID'	=> $request->input('tourID'),
				'day'		=> $request->input('day'),
				'countryID'	=> $request->input('countryID'),
				'cityID'	=> $request->input('cityID'),
				'hotelID'	=> $request->input('hotelID'),
				'siteID'	=> $request->input('siteID'),
				'meal'	     => $request->input('meal'),
				'optionaltourID'	=> $request->input('optionaltourID'),
				'title'	        => $request->input('title'),
				'description'	=> $request->input('description'),
				'icon'	         => $request->input('icon'),
				'image'	        => $request->input('image')
			);
		if($request->input('tourdetailID') =='')
		{
			\DB::table('tour_detail')->insert($data);
			return Redirect::to('tours/show/'. $request->input('tourID'))
	        	->with('messagetext','New day has been added !')->with('msgstatus','success');
		} else {
			\DB::table('tour_detail')->where('tourdetailID',$request->input('tourdetailID'))->update($data);
			return Redirect::to('tours/show/'. $request->input('tourID'))
	        	->with('messagetext','Day has been updated !')->with('msgstatus','success');
		}



	}

	public function getTourdetaildelete( Request $request , $tourID , $tourdetailID =0)
	{
		\DB::table('tour_detail')->where('tourdetailID',$tourdetailID)->where('tourID',$tourID)->delete();
			return Redirect::to('tours/show/'. $tourID)
	        	->with('messagetext','Day has been deleted !')->with('msgstatus','success');
	}

    static public function placesToVisit( $places = '')
	{
		$placestovisit='';
		if($places !='')
		{
			$sql2 = \DB::table('def_sites')->whereIn('siteID',explode(',',$places))->get();
			foreach ($sql2 as $v2) {

				$placestovisit .= "<span class='label label-success'>".$v2->site_name."</span>&nbsp; ";
			}
		}
		return $placestovisit;
	}

    static public function optionalTours( $optionals = '')
	{
		$optionalTours='';
		if($optionals !='')
		{
			$sql3 = \DB::table('def_optional_tours')->whereIn('optionaltourID',explode(',',$optionals))->get();
			foreach ($sql3 as $v3) {

				$optionalTours .= "<span class='label label-primary'>".$v3->optional_tour."</span>&nbsp; ";
			}
		}
		return $optionalTours;
	}

    static public function whatsIncluded( $inclusions = '')
	{
		$whatsIncluded='';
		if($inclusions !='')
		{
			$sql4 = \DB::table('def_inclusions')->whereIn('inclusionID',explode(',',$inclusions))->get();
			foreach ($sql4 as $v4) {

				$whatsIncluded .= "<li>".$v4->inclusion."</li> ";
			}
		}
		return $whatsIncluded;
	}

}
