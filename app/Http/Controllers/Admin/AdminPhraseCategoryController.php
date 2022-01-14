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

class AdminPhraseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $baseCategory_id = $req->input("bc");

        $baseCategoryLabels = BaseCategoryMaster::labels();
        $phraseCategories = PhraseCategory::orderBy('id','desc')->paginate(10);

        if($baseCategory_id){
            $phraseCategories = PhraseCategory::whereHas("baseCategories", function($query) use($baseCategory_id) {
				
				//ここはBaseCategoryの絞り込み条件を書く
				$query->where("code", $baseCategory_id);

			})->orderBy("id", "desc")->paginate(10);

            return view('admin.phrase_categories.index', compact('phraseCategories', 'baseCategoryLabels'));
        }

        return view('admin.phrase_categories.index', compact('phraseCategories', 'baseCategoryLabels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.phrase_categories.create',[
            "base_categories" => BaseCategoryMaster::all()
        ]);
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
            'phrase_category'=>'required',
            "base_categories" => 'required'
        ]);

        $phrase_category = new PhraseCategory();
        $phrase_category->phrase_category = $request->get('phrase_category');

        $phrase_category->save();

        //base_categories
        $base_categories = $request->get('base_categories');
        foreach($base_categories as $code){
            $baseCategory = new BaseCategory();
            $baseCategory->phrase_category_id = $phrase_category->id;
            $baseCategory->code = $code;
            $baseCategory->save();
        }

        return redirect()->route("admin.phrase_category.index")->with('success', '作成完了しました!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phraseCategory = PhraseCategory::find($id);
        $selected_basies = $phraseCategory->baseCategories->pluck("code")->toArray();//base_categoryのcodeカラム
        $base_categories = BaseCategoryMaster::all();

        
        return view('admin.phrase_categories.edit', compact('phraseCategory', 'base_categories', 'selected_basies'));
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
        $phraseCategory = PhraseCategory::find($id);

        $request->validate([
            'phrase_category'=>'required',
            "base_categories" => 'required'
        ]);

        $phraseCategory->phrase_category = $request->get('phrase_category');

        $phraseCategory->save();

        //base_categories
        $base_categories = $request->get('base_categories');//checkされた項目
        
        //元々追加済み
        $selected_basies = $phraseCategory->baseCategories->pluck("code")->toArray();

        //増えていく
        //要らないものは削除する
        //check外したらdbから消えてください
        $phraseCategory->baseCategories()->each(function($baseCategory) use($base_categories){
            
            if(in_array($baseCategory->code, $base_categories)){
                //チェックが入っているので削除しない
                //絡むにその項目が登録されていたら
                return;
                //continue;
                
            }

            //解除されたらデータから消す
            $baseCategory->delete();
        });

        foreach($base_categories as $code){//checkされた項目の個々が｢code｣に存在しているものならスルー
            
            if(in_array($code, $selected_basies)){//0→express,1→actionの配列にinputされた値があれば置き換えるor無視して
                //既に作成済みなので追加しない
                continue;//breakだと強制終了//return;も終わってしまう
            }
            //なかったら登録
            $baseCategory = new BaseCategory();
            $baseCategory->phrase_category_id = $phraseCategory->id;
            $baseCategory->code = $code;
            $baseCategory->save();
        }

        return redirect()->route("admin.phrase_category.index")->with('success', '作成完了しました!');
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
        PhraseCategory::find($id)->delete();
        return redirect()->route("admin.phrase_category.index")->with('success', '削除しました!');
    }
    
}
