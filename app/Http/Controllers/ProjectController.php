<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DocType;
use App\Models\Gift;
use App\Models\Location;
use App\Models\Project;
use App\Notifications\ProjectModerate;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    protected $per_page = 16;
    protected $filters = ['favourite'=>'Популярные', 'start'=>'Новые', 'successfully'=>'Успешные', 'completed'=>'Завершенные'];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }



    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->getProjectsData();
        return view('projects.index', $data);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function page()
    {
        $data = $this->getProjectsData();

        return [
          'status'  => 'ok',
          'projects' => view('projects.list', $data)->render(),
        ];
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        $data = $this->getProjectsData();

        return [
          'status'  => 'ok',
          'html' => view('projects.parts.projects', $data)->render(),
            'url' => 'projects?filter='.$data['active_filter'].'&category='.$data['active_category']
        ];
    }

    protected function getProjectsData() {
        $page = request('pageNum', 0);
        $active_filter = request('filter', 'favourite');

        $active_category = request('category');
        $query = Project::published()->$active_filter();
        if ($active_category) {
            $query->whereCategoryId($active_category);
        }
        $projects = $query->paginate($this->per_page, ['*'], 'pageNum', $page);
        $categories = Category::withCount('projects')->get();
        $filters = $this->filters;
        $total = $projects->total();
        $more = $total && !$projects->lastPage();
        return compact('projects', 'active_category', 'categories', 'active_filter', 'filters', 'more', 'total');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = Project::create(['user_id' => Auth::user()->id]);
        return redirect('project/'.$project->id.'/update');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function complete(Project $project)
    {
        return view('projects.complete', compact('project'));
    }

    public function update(Project $project)
    {
        $categories = Category::all()->pluck('title', 'id')->toArray();
        $locations = Location::all()->pluck('name', 'name')->toArray();
        $docs = DocType::all()->pluck('name', 'id')->toArray();
        return view('projects.update', compact('project', 'categories', 'locations', 'docs'));
    }

    public function updateSave(Project $project)
    {
        $project->status = Project::STATUS_MODERATION;
        $project->save();

        $project->user->notify(new ProjectModerate($project));
        return redirect('project/'.$project->id.'/complete');
    }

    public function storeField() {
        $data = request()->all();
        $project = Project::find($data['projectId']);

        if (key_exists($data['fieldName'], $project->getAttributes())) {
            $project->{$data['fieldName']} = $data['fieldValue'];
            $project->save();
        } elseif (key_exists($data['fieldName'], $project->user->getAttributes())) {
            $project->user->{$data['fieldName']} = $data['fieldValue'];
            $project->user->save();
        }
        return ['date' => $project->updated_at->format('H:i:s')];
    }

    public function store() {
        $data = request()->all();
        $project = Project::find($data['projectId']);
        $project->fill($data['project']);
        $project->save();

        if (!empty($data['user'])) {
            $project->user->fill($data['user']);
            $project->user->save();
        }

        $ret = ['date' => $project->updated_at->format('H:i:s')];
        if (!empty($data['project_preview'])) {
            $ret['redirect_url'] = url('project/'.$project->id, ['token' => $project->viewToken]);
        }
        return $ret;
    }


    public function storeClientField() {
        $data = request()->all();
        $user = User::find($data['clientId']);
        $user->{$data['fieldName']} = $data['fieldValue'];
        $user->save();
        return ['date' => $user->updated_at->format('H:i:s')];
    }


    public function delete(Project $project) {
        $project->delete();
        return redirect('/profile/'.Auth::user()->id);
    }

    public function view(Project $project) {
        $project = Project::withCount(['comments', 'sponsors'])->findOrFail($project->id);
        // todo: token validation
        if (!$project->status) {
        }
        $tab = request('tab', 'about');

        return view('projects.view', compact('project', 'tab'));
    }

    public function viewTab(Project $project, Request $request) {

        $tab = explode('/', $request->path())[2];
        return [
          'status'  => 'ok',
          'content' => view('projects.tabs.'.$tab, compact('project'))->render(),
        ];
    }

    public function pay1(Project $project) {

        $data = request()->all();

        return view('projects.pay1', compact('project', 'data'));
    }

    public function savePaymentData()
    {
        session(['payment-data' => request()->all()]);
    }

    public function pay2(Project $project, Gift $gift = null) {
        $data = request()->all();
        if (empty($data)) {
            $data = session('payment-data', []);
        }
        if (empty($data) && $gift->id) {
            $data['sum'] = floatval(str_replace(' ', '', $gift->sum));
        }

        if (!$gift->id && !empty($data['compensation_id'])) {
            $gift = Gift::findOrFail($data['compensation_id']);
        }

        return view('projects.pay2', compact('project', 'gift') + $data);
    }

    public function error(Request $request) {
        return view('pages.error');
    }

    public function search(Request $request) {

        $projects = Project::published()->where('name', 'like', '%'.$request->get('search_text').'%')->get();
        return view('projects.list', compact('projects'));
    }
}
