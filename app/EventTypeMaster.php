<?php

namespace App;

class EventTypeMaster
{
    public static function all(){

        $all = [];

        $all[] = self::getMaster("phraseAboutSituationEvent");
        //$all[] = self::getMaster("phraseAboutGroupedTagEvent");
        //$all[] = self::getMaster("phraseAboutPhraseCategoryEvent");
        
        return $all;
    }

    public static function labels(){
        $all = self::all();
        $labels = [];

        foreach($all as $master){
            $labels[$master->event_type] = $master->label;
        }

        return $labels;
    }

    /**
     * @return EventTypeMaster 
     */
    public static function getMaster($type){

        switch($type){
            case "phraseAboutSituationEvent":
                return new EventTypeMaster("phraseAboutSituationEvent", "状況フレーズ");

            // case "phraseAboutGroupedTagEvent" :
            //     return new EventTypeMaster("phraseAboutGroupedTagEvent", "グループタグフレーズ");

            // case "phraseAboutPhraseCategoryEvent" :
            //     return new EventTypeMaster("phraseAboutPhraseCategoryEvent","表現");

            // case "hushTagRelatedPhraseEvent" :
            //     return new EventTypeMaster("hushTagRelatedPhraseEvent","タグ関連フレーズ");

        }

        return null;
        
    }

    public $event_type;

    public $label;

    private function __construct($event_type, $label){
        $this->event_type = $event_type;
        $this->label = $label;
    }

}