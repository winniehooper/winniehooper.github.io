<?php

namespace App\Http\Controllers;

use Backpack\MenuCRUD\app\Models\MenuItem;
use Backpack\PageManager\app\Models\Page;

class PageController extends Controller
{
    public function index($slug)
    {
        $page = Page::findBySlug($slug);

        if (!$page)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        $menu = MenuItem::all();

        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $this->data['menu'] = $menu;
        //dd($this->data['page']);

        return view('pages.'.$page->template, $this->data);
    }
}
