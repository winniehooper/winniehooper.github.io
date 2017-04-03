<?php

namespace App\Http\Controllers;

use App\Models\WebSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class WebSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $site = $user->webSites()->create(['website_url' => $request->get('website_url')]);
        return ['status' => 'success', 'id' => $site->id];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebSite  $webSite
     * @return \Illuminate\Http\Response
     */
    public function show(WebSite $webSite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebSite  $webSite
     * @return \Illuminate\Http\Response
     */
    public function edit(WebSite $webSite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WebSite  $webSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebSite $webSite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::user();
        $website = WebSite::findOrFail(request('website_id'));
        if ($website->user_id != $user->id) {
            throw new AccessDeniedException();
        }

        $website->delete();
        return ['status' => 'success'];
    }
}
