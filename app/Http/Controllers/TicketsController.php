<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Airlines;
use App\Models\Ticket;
use App\Models\Airports;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class TicketsController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();
	public $module = 'tickets';
	static $per_page	= '10';

	public function __construct()
	{
		parent::__construct();
		$this->model = new Ticket();
        $this->info = $this->model->makeInfo( $this->module);
        $module_id =  \DB::table('tb_module')->where('module_name', $this->module)->first()->module_id;
		$this->access = $this->model->validAccess($module_id);
        $this->data = array(
            'pageTitle'			=> 	'tickets',
            'pageNote'			=>  'tickets',
            'pageModule'		=> 'tickets',
            'pageUrl'			=>  url('tickets'),
            'return' 			=> 	self::returnUrl()
        );


	}


	public function getIndex()
	{
		if($this->access['is_view'] ==0)
			return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');

        $this->data['access']		= $this->access;
        $this->data['items'] = Ticket::all();
        $this->data['airlines'] = Airlines::all();
        $this->data['airports'] = Airports::all();

        $this->data['tableGrid'] 	= $this->info['config']['grid'];
        $this->data['tableForm'] 	= $this->info['config']['forms'];
        $this->data['colspan'] 		= \App\Library\SiteHelpers::viewColSpan($this->info['config']['grid']);
        // Group users permission
        $this->data['access']		= $this->access;
        // Detail from master if any
        $this->data['setting'] 		= $this->info['setting'];

        // Master detail link if any
        $this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
		return view('tickets.index',$this->data);
	}


	public  function getEdit(Request $request){

	    $data['ticket'] = Ticket::where('ticketID',$request->id)->first();
        $data['airlines'] = Airlines::all();
        $data['airports'] = Airports::all();
        $view = view('tickets.form',$data)->render();
        return response()->json(['status'=>'success','view'=>$view]);

    }
    function update(Request $request,$id){
        $ticket = Ticket::where('ticketID',$id)->first();
        $request['airlinesID'] = json_encode($request->airlinesID);
        $ticket->update($request->all());
        return response()->json(['status'=>'success','message'=>__('core.note_success')]);
    }
	public function postData( Request $request)
	{

	    $data['items'] = Ticket::all();
		// Render into template
		return view('tickets.table',$data);

	}

	function store(Request $request){
	    $request->validate([
	        'airlinesID'=>'required',
//	        'airlineID'=>'required',
	        'returnn'=>'required',
	        'depairportID'=>'required',
	        'arrairportID'=>'required',
	        'departing'=>'required',
        ]);

        $request['airlinesID'] = json_encode($request->airlinesID);
	    Ticket::create($request->all());
	    return response()->json(['status'=>'success','message'=>__('core.note_success')]);
    }


}
