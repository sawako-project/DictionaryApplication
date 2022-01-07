<?php

namespace App;



class BaseCategoryMaster 
{
    public static function all(){

        $all = [];

        $all[] = new BaseCategoryMaster("action",     "動作", "例)食べる");
        $all[] = new BaseCategoryMaster("expression", "表情", "例)笑う");
        $all[] = new BaseCategoryMaster("feeling",    "感情", "例)嬉しい");
        
        return $all;
    }

    public static function labels(){
        $all = self::all();
        $labels = [];

        foreach($all as $master){
            $labels[$master->code] = $master->label;
        }

        return $labels;
    }

    public $code;
    public $label;
    public $sample;
    public $categories = [];

    private function __construct($code, $label, $sample){
        $this->code = $code;
        $this->label = $label;
        $this->sample = $sample;
    }

}