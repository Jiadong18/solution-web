<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Staff;
use App\Models\Countries;
use App\Models\StaffType;
use App\Models\Cities;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect;

class StaffTypeController extends Controller
{

    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'stafftypes';
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
            'pageModule' => 'stafftypes',
            'pageUrl' => url('staffs/types'),
            'return' => self::returnUrl()
        );

    }

    public function index()
    {
        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $this->data['access'] = $this->access;
        $this->data['items'] = StaffType::all();
        return view('staff_types.index', $this->data);
    }

    public function edit(Request $request)
    {

        $data['staff'] = StaffType::find($request->id);
        $view = view('staff_types.form', $data)->render();
        return response()->json(['status' => 'success', 'view' => $view]);

    }

    function update(Request $request, $id)
    {
        $request->validate([
            'staff_type' => 'required',
            'status' => 'required',
        ]);

        $staff = StaffType::find($id);
        $staff->update($request->all());
        return response()->json(['status' => 'success', 'message' => __('core.note_success')]);
    }

    function store(Request $request)
    {
        $request->validate([
            'staff_type' => 'required',
            'status' => 'required',
        ]);

        StaffType::create($request->all());
        return response()->json(['status' => 'success', 'message' => __('core.note_success')]);
    }


}
