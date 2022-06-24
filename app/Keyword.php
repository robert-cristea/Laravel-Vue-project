<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public $keys = [
        'staff_commuting',
        'fleet_vehicle',
        'old_electric_consumption',
        'new_electric_consumption',
        'old_water_consumption',
        'new_water_consumption',
        'waste_transportation',
        'waste_categories',
        'paper',
        'patrolling',
        'repainting',
        'replacement_of_utilities',
        'machinery_work',
        'activities',
        'fuel',
        'tree_carbon_sequestration',
        'machinery_work_patching',
        'machineries_equipment',
        'construction_materials',
        'transport_materials',
        'transportation_of_material',
        'production_material_used',

        'emissions_factor__utilities_fuels',
        'emissions_factor__vehicle',
        'emissions_factor__transportation',
        'emissions_factor__machineries_equipment',
        'emissions_factor__production',
        'emissions_factor__conversion_factor',
        'emissions_factor__material_density'
    ];

    public static $emissionFactorKeys = [
        'emissions_factor__utilities_fuels' => 1,
        'emissions_factor__vehicle' => 2,
        'emissions_factor__transportation' => 3,
        'emissions_factor__machineries_equipment' => 4,
        'emissions_factor__production' => 5,
        'emissions_factor__conversion_factor' => 6,
        'emissions_factor__material_density' => 7
    ];

    protected $fillable = [
        'type'
    ];

    public static function getDataForProjectCreation() 
    {
        $data = [];
        $keywords = Keyword::whereIn('type', array_keys(self::$emissionFactorKeys))->get();

        foreach($keywords as $keyword) {
            if(!isset($data[$keyword->type])) {
                $data[$keyword->type] = [];
            }
            $items = KeywordItem::where('keyword_id', '=', $keyword->id)->get();
            $keywordData = [];
            foreach($items as $item) {
                if($item->name == 'factor') {
                    $value = str_replace(',', '.', $item->value);
                    $keywordData[$item->name] = (float)$value;
                }
                else if(preg_match('/^[+-]?(([0-9]+)|([0-9]*\.[0-9]+|[0-9]+\.[0-9]*)|
(([0-9]+|([0-9]*\.[0-9]+|[0-9]+\.[0-9]*))[eE][+-]?[0-9]+))$/', $item->value)) {
                    $keywordData[$item->name] = (float)$item->value;
                }
                else if(is_numeric($item->value)) {
                    $keywordData[$item->name] = (int)$item->value;
                }
                else {
                    $keywordData[$item->name] = $item->value;
                }
            }
            $keywordData['id'] = $keyword->id;
            $data[$keyword->type][$keyword->id] = $keywordData;
        }
        return $data;
    }

    /**
     * Gets all data to be displayed in the front.
     * @return array
     */
    public static function getGlobalData($keySearch = '') 
    {
        $data = [];
        $keywords = Keyword::all();
       
        foreach($keywords as $keyword) {
            if(!isset($data[$keyword->type])) {
                $data[$keyword->type] = [];
            }
         
            $items = KeywordItem::where('keyword_id', '=', $keyword->id)->get();
            if(!empty($keySearch)) {
                $items = KeywordItem::where(function($q) use ($keyword, $keySearch) {
                    $q->where('keyword_id', '=', $keyword->id);
                    $q->where('value', 'like', '%'.$keySearch.'%');
                })->get();
            }
            $keywordData = [];
            foreach($items as $item) {
                // fix commas for floats stored
                if($item->name == "distance" && strpos($item->value, ",")) {
                    $item->value = str_replace(",", ".", $item->value);
                }
                if(preg_match('/^[+-]?(([0-9]+)|([0-9]*\.[0-9]+|[0-9]+\.[0-9]*)|
(([0-9]+|([0-9]*\.[0-9]+|[0-9]+\.[0-9]*))[eE][+-]?[0-9]+))$/', $item->value)) {
                    $keywordData[$item->name] = (float)$item->value;
                }
                else if(is_numeric($item->value)) {
                    $keywordData[$item->name] = (int)$item->value;
                }
                else {
                    $keywordData[$item->name] = $item->value;
                }
            }
            $keywordData['id'] = $keyword->id;
            if(empty($keywordData['title'])) {
                $keywordData['title'] = '';
            }
            $data[$keyword->type][$keyword->id] = $keywordData;
        }
        return $data;
    }

    /**
     * Gets current Keyword keys and values.
     * @return array
     */
    public function getData() 
    {
        $data = [];
        $keywordData = KeywordItem::where('keyword_id', '=', $this->id)->get()->toArray();
        foreach($keywordData as $value) {
            $data[$value['name']] = $value['value'];
        }
        $data['id'] = $this->id;
        $data['type'] = $this->type;
        if(empty($data['title'])) {
            $data['title'] = '';
        }
        return $data;
    }
}
