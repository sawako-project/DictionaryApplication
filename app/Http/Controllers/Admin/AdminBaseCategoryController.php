<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Phrase;
use App\PhraseCategory;
use App\BaseCategory;
use App\BaseCategoryMaster;
use App\PhraseTag;
use App\Word;

class AdminBaseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $base_categories = BaseCategory::orderBy('id','desc')->get();
        return view('admin.base_categories.index', compact('base_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.base_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'base_category'=>'required',
        ]);

        $baseCategory = new BaseCategory();//base_category
        $baseCategory->base_category = $request->get('base_category');
        $baseCategory->save();

        return redirect()->route("admin.base_category.index")->with('success', 'saved!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $baseCategory = BaseCategory::find($id);
    //     return view('admin.base_categories.show', compact('baseCategory'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $baseCategory = BaseCategory::find($id);
        return view('admin.base_categories.edit', compact('baseCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $baseCategory = BaseCategory::find($id);

        $request->validate([
            'base_category'=>'required',
        ]);

        $baseCategory->base_category = $request->get('base_category');
        $baseCategory->save();

        return redirect()->route("admin.base_category.index")->with('success', 'saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        BaseCategory::find($id)->delete();
        return redirect()->route("admin.base_category.index")->with('success', 'deleted!');
    }
    
}