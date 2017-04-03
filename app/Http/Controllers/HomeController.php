<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FaqCategory;
use App\Models\Feedback;
use App\Models\Project;
use App\User;
use Backpack\MenuCRUD\app\Models\MenuItem;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index()
    {
        $favourites = Project::published()->favourite()->latest()->limit(5)->get();
        $super = $favourites->shift();
        $successfully = Project::published()->successfully()->latest()->limit(4)->get();
        $new = Project::published()->start()->latest()->limit(4)->get();
        $categories = Category::all();
        return view('index', compact('super', 'favourites', 'categories', 'successfully', 'new'));
    }

    public function faq()
    {
        $menu = MenuItem::all();
        $categories = FaqCategory::with('questions')->get();
        return view('pages.faq', compact('categories', 'menu'));
    }

    public function error(Request $request) {
        return view('pages.error');
    }

    public function setBackUrl(Request $request) {
        return ['status'=>'ok'];
    }

    public function sendFeedback(Request $request) {

        $this->validate($request, [
          'userName' => 'required|max:255',
          'subject' => 'required|max:255',
          'feedbackText' => 'required|max:1024',
        ]);

        $feedback = Feedback::create(
          $request->only(['userName', 'subject', 'feedbackText', 'userEmail'])
        );

        return [
          'status'=>'success',
            'message' => 'Сообщение отправлено',
        ];
    }

}
