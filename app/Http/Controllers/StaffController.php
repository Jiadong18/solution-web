<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Staff;
use App\Models\Countries;
use App\Models\StaffType;
use App\Models\Cities;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect;

class StaffController extends Controller
{

    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'staffs';
    static $per_page = '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Staff();

        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);

        $this->data = array(
            'pageTitle' => $this->info['title'],
            'pageNote' => $this->info['note'],
            'pageModule' => 'staffs',
            'pageUrl' => url('staffs'),
            'return' => self::returnUrl()
        );

    }

    public function index()
    {
        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $this->data['access'] = $this->access;
        $this->data['items'] = Staff::all();
        $this->data['staff_types'] = StaffType::all();
        $this->data['countries'] = Countries::all();
        $this->data['cities'] = Cities::all();
        return view('staffs.index', $this->data);
    }

    public function edit(Request $request)
    {

        $data['staff'] = Staff::find($request->id);
        $data['staff_types'] = StaffType::all();
        $data['countries'] = Countries::all();
        $data['cities'] = Cities::all();
        $view = view('staffs.form', $data)->render();
        return response()->json(['status' => 'success', 'view' => $view]);

    }

    function update(Request $request, $id)
    {
        $request->validate([
            'stafftypeID' => 'required',
            'email' => 'required',
            'countryID' => 'required',
            'cityID' => 'required',
            'status' => 'required',
        ]);

        $ticket = Staff::where('staffID', $id)->first();
        $request['airlinesID'] = json_encode($request->airlinesID);
        $ticket->update($request->all());
        return response()->json(['status' => 'success', 'message' => __('core.note_success')]);
    }

    function store(Request $request)
    {
        $request->validate([
            'stafftypeID' => 'required',
            'email' => 'required',
            'countryID' => 'required',
            'cityID' => 'required',
            'status' => 'required',
        ]);

        Staff::create($request->all());
        return response()->json(['status' => 'success', 'message' => __('core.note_success')]);
    }


}
