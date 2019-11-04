<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Post;
use App\Library\Slimdown;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;


class PostController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();
	public $module = 'post';
	static $per_page	= '10';

	public function __construct()
	{

		$this->model = new Post();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);

		$this->data = array_merge(array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'post',
			'return'	=> self::returnUrl()

		),$this->data);

	}

	public function getIndex( Request $request)
	{
        $model  = new Post();
		$info = $model::makeInfo('post');
        $sort   = ((isset($_GET['sort']))  ? $_GET['sort']  : 'created');
        $order  = ((isset($_GET['order'])) ? $_GET['order'] : 'desc');
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$data['conpost']        = json_decode(file_get_contents(base_path().'/resources/views/core/posts/config.json'),true);
		$params = array(
			'page'		=>  $page ,
			'limit'		=>  !is_null($data['conpost']['commperpage']) ? $data['conpost']['commperpage']  : 5 ,
			'sort'		=>  $sort,
			'order'		=>  $order,
			'params'	=>  " AND pagetype ='post'  " ,
			'global'	=> 1
		);
        return self::articles( $params , $page , 'all' );

	}


	public function getLabel( Request $request , $label )
	{

		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$params = array(
			'page'		=> $page ,
			'limit'		=>  (isset($_GET['rows']) ? filter_var($_GET['rows'],FILTER_VALIDATE_INT) : 10 ) ,
			'sort'		=> 'created' ,
			'order'		=> 'desc',
			'params'	=> " AND pagetype ='post' AND labels REGEXP '". $label."' " ,
			'global'	=> 1
		);
		return self::articles( $params , $page , $label );

	}


	public static function articles($params , $page , $title = 'all')
	{

		$model  = new Post();
		$info = $model::makeInfo('post');

		$data['pageLang'] = 'en';
		if(\Session::get('lang') != '')
		{
			$data['pageLang'] = \Session::get('lang');
		}

		$result = $model::getRows( $params );
		$data['rowData'] 	= $result['rows'];

        $page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
        $pagination = new Paginator($result['rows'], $result['total'], $params['limit']);
        $pagination->setPath('');
        $data['i']			= ($page * $params['limit'])- $params['limit'];

		if($title !='all')
		{
			$data['pageTitle'] 	= $title;
			$data['pageImage'] 	= CNF_HEADERIMAGE;

		} else {
			$data['pageTitle'] 	= 'Blog';
            $data['pageImage'] 	= CNF_HEADERIMAGE;
		}

		$data['pageNote'] 	    =  'View All';
		$data['breadcrumb'] 	= 'false';
		$data['pageMetakey'] 	=  '' ;
		$data['pageMetadesc']   =  '' ;
		$data['homepage']       =  '0' ;
		$data['filename'] 	    =  '';
		$data['clouds']		    = self::cloudtags();
		$data['latestposts']	= $model::latestposts();
		$data['popularposts']	= $model::popularposts();
        $data['pagination']     = $pagination;
		$data['conpost']        = json_decode(file_get_contents(base_path().'/resources/views/core/posts/config.json'),true);
		$page                   = 'layouts.'.CNF_THEME.'.index';
		$data['pages']          = 'post.index';

		if(file_exists(base_path().'/resources/views/layouts/'.CNF_THEME.'/blog/index.blade.php'))
		{
			$data['pages'] = 'layouts.'.CNF_THEME.'.blog.index';
		}
		return view($page,$data);

	}


	function getUpdate(Request $request, $id = null)
	{

		if($id =='')
		{
			return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}

		if($id !='')
		{
			return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}

		$row = $this->model->find($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_pages');
		}
		$this->data['fields'] 		=  \App\Library\SiteHelpers::fieldLang($this->info['config']['forms']);

		$this->data['id'] = $id;
		return view('post.form',$this->data);
	}

	public function getView( Request $request, $id = null)
	{

		$row = $this->model->getRow($id);
		if($row)
		{
			\DB::table('tb_pages')->where('pageID',$row->pageID)->update(array('views'=> \DB::raw('views+1')));
			if($row->access !='')
			{
				$access = json_decode($row->access,true)	;
			} else {
				$access = array();
			}

			// If guest not allowed
			if($row->allow_guest !=1)
			{
				$group_id = \Session::get('gid');
				$isValid =  (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
				if($isValid ==0)
				{
					return Redirect::to('post')
						->with('messagetext', \App\Library\SiteHelpers::alert('error',\Lang::get('core.note_restric'). '<br /><b>Post Name : '. $row->title.'</b>'));
				}
			}


			$data['pageLang'] = 'en';
			if(\Session::get('lang') != '')
			{
				$data['pageLang'] = \Session::get('lang');
			}

			$data['conpost'] = json_decode(file_get_contents(base_path().'/resources/views/core/posts/config.json'),true);

			$data['pageTitle'] 		= 	($row->title !='' ? $row->title : 'BLOG') ;
			$data['pageImage'] 		= 	($row->image !='' ? $row->image : CNF_HEADERIMAGE) ;
			$data['pageNote'] 		=  	'View All';
			$data['breadcrumb'] 	= 	'inactive';
			$data['pageMetakey'] 	=  	$row->metakey;
			$data['pageMetadesc'] 	=  	$row->metadesc ;
			$data['homepage'] 	    =  	$row->default ;
			$data['filename'] 		=  	'';

			$data['row']            =  $row;
			$data['fields'] 		=  \App\Library\SiteHelpers::fieldLang($this->info['config']['grid']);
			$data['id']             = $id;
			$data['access']		    = $this->access;
			$data['prevnext']       = $this->model->prevNext($id);
			$data['labels']	        = self::splitLabels($row->labels);
			$data['comments']	    = $this->model->comments($row->pageID);
			$data['clouds']		    = self::cloudtags();
			$data['latestposts']	= $this->model->latestposts();
			$data['popularposts']	= $this->model->popularposts();
			$page                   = 'layouts.'.CNF_THEME.'.index';
			$data['pages']          = 'post.view';
			if(file_exists(base_path().'/resources/views/layouts/'.CNF_THEME.'/blog/view.blade.php'))
			{
				$data['pages'] = 'layouts.'.CNF_THEME.'.blog.view';
			}
			return view($page,$data);
		} else {
			return Redirect::to('post')->with('messagetext','Record Not Found !')->with('msgstatus','error');
		}
	}

	function postSave( Request $request)
	{

		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$data = $this->validatePost('tb_post');

			$id = $this->model->insertRow($data , $request->input('pageID'));

			if(!is_null($request->input('apply')))
			{
				$return = 'blog/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'post?return='.self::returnUrl();
			}

			// Insert logs into database
			if($request->input('pageID') =='')
			{
				\App\Library\SiteHelpers::auditTrail( $request , 'New Data with ID '.$id.' Has been Inserted !');
			} else {
				\App\Library\SiteHelpers::auditTrail($request ,'Data with ID '.$id.' Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');

		} else {

			return Redirect::to('blog/update/'.$request->input('pageID'))->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
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

			\App\Library\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('post?return='.self::returnUrl())
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success');

		} else {
			return Redirect::to('post?return='.self::returnUrl())
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');
		}

	}

	public static function splitLabels($value='')
	{
		$value = explode(',',$value);
		$vals = '';
		foreach($value as $val)
		{
			$vals .= '<a href="'.url('blog/label/'.trim($val)).'" class="btn btn-xs btn-default"> '.trim($val).' </a> ';
		}
		return $vals;
	}

	public static function cloudtags()
	{
		$tags = array();
		$keywords = array();
		$word = '';
		$data = \DB::table('tb_pages')->where('pagetype','post')->get();
		foreach($data as $row)
		{
			$clouds = explode(',',$row->labels);
			foreach($clouds as $cld)
			{
				$cld = strtolower($cld);
				if (isset($tags[$cld]))
				{
					$tags[$cld] += 1;
				} else {
					$tags[$cld] = 1;
				}
				//$tags[$cld] = trim($cld);
			}
		}

		ksort($tags);
		foreach($tags as $tag=>$size)
		{
			//$size += 12;
			$word .= "<a href='".url('blog/label/'.trim($tag))."'><span class='cloudtags' ><i class='fa fa-tag'></i> ".ucwords($tag)." (".$size.") </span></a> ";
		}

		return $word;
	}

	public static function latestpost()
	{

	}

	public function postComment( Request $request)
	{
		$rules = array();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {

			$data = array(
					'userID'		=> \Session::get('uid'),
					'posted'		=> date('Y-m-d H:i:s') ,
					'comments'		=> $request->input('comments'),
					'pageID'		=> $request->input('pageID')
				);

			\DB::table('tb_comments')->insert($data);
			return Redirect::to('blog/view/'.$request->input('pageID').'/'.$request->input('alias'))
        		->with('messagetext', \App\Library\SiteHelpers::alert('success','Thank You , Your comment has been sent !'))->with('msgstatus','success');
		} else {
			return Redirect::to('blog/view/'.$request->input('pageID').'/'.$request->input('alias'))
        		->with('messagetext',\App\Library\SiteHelpers::alert('error','The following errors occurred'))->with('msgstatus','error');
		}
	}

	public function getRemove( Request $request, $pageID , $alias , $commentID )
	{
		if($commentID !='')
		{
			\DB::table('tb_comments')->where('commentID',$commentID)->delete();
			return Redirect::to('blog/view/'.$pageID.'/'.$alias)
        		->with('messagetext', \App\Library\SiteHelpers::alert('success','Comment has been deleted !'))->with('msgstatus','success');

		} else {
			return Redirect::to('blog/view/'.$pageID.'/'.$alias)
        		->with('messagetext', \App\Library\SiteHelpers::alert('error','Failed to remove comment !'))->with('msgstatus','error');
		}
	}

	static function display()
	{
		return 'MMB';
	}

}
