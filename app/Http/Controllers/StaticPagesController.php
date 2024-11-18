<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    /**
     * Show the FAQ page.
     *
     * @return \Illuminate\View\View
     */
    public function showFaqPage()
    {
        return view('pages.faq');
    }

    /**
     * Show the Plant Disciple Page.
     *
     * @return \Illuminate\View\View
     */
    public function showPlantDiscPage()
    {
        return view('pages.plantDisc');
    }

    /**
     * Show the Tips for Building Relationships Page.
     *
     * @return \Illuminate\View\View
     */
    public function showTipsForBuildingRelationships()
    {
        return view('pages.tipsForBuildingRelationships');
    }

    /**
     * Show the Gabay Page.
     *
     * @return \Illuminate\View\View
     */
    public function showGabayPage()
    {
        return view('pages.gabay');
    }
}
