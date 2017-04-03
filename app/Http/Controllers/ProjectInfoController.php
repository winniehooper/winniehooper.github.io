<?php

namespace App\Http\Controllers;

use App\Models\StudyInfoPage;
use Illuminate\Http\Request;
use App\User;

class ProjectInfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->get('page');
        //dd($page);
        return view('pages.projects.info');
    }

    protected function getNavPages() {
        return StudyInfoPage::all()->where('id', '>', 1)->pluck('title', 'id')->toArray();
    }

    public function study()
    {
        $page = StudyInfoPage::find(1);
        $all = $this->getNavPages();
        return view('pages.projects.main', compact('page', 'all'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function studyPage(StudyInfoPage $page)
    {
        $all = $this->getNavPages();
        $i = array_search($page->id, array_keys($all));
        $prev = ['url'=> url('/study'), 'title'=>'Назад'];
        $next = [];
        if ($i > 1) {
            $prev = ['url' => url('/study/'.($i+1)), 'title'=>$all[$i+1]];
        }
        if ($i+1 < count($all)) {
            $next = ['url' => url('/study/'.($i+3)), 'title'=>$all[$i + 3]];
        }
        return view('pages.projects.study',
          ['page' => $page, 'all' => $all, 'prev' => $prev, 'next' => $next]);
    }

}
