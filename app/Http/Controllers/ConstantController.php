<?php

namespace App\Http\Controllers;

use App\Keyword;
use App\KeywordItem;
use Illuminate\Http\Request;

class ConstantController extends Controller
{
    public function index(Request $request)
    {
        $keywords = '';
        if($request->get('keywords') != '') {
            $keywords = $request->get('keywords');
        }
        $globalData = Keyword::getGlobalData($keywords);
        $masterKeys = $this->getMasterKeys($globalData);
        $data = [
            'keywords' => $keywords,
            'keywordList' => $globalData,
            'masterKeys' => $masterKeys
        ];
        return view('admin.constants.list', $data);
    }

    public function show($keywordId) {
        $keyword = Keyword::findOrFail($keywordId); /** @var Keyword $keyword*/
        $keywordData = $keyword->getData();
        $globalData = Keyword::getGlobalData();
        $masterKeys = $this->getMasterKeys($globalData);
        $data = [
            'keyword' => $keywordData,
            'keywordList' => $globalData,
            'masterKeys' => $masterKeys,
        ];
        return view('admin.constants.list', $data);
    }

    public function store(Request $request) {
        $data = $request->all();
        if(!empty($data['id'])) {
            $keyword = Keyword::findOrFail($data['id']); /** @var Keyword $keyword*/
            foreach($data as $key => $value) {
                if($key == 'type' || $key == 'id' || $key == 'title') {
                    continue;
                }
                $updated = KeywordItem::where('keyword_id', '=', $keyword->id)
                    ->where('name', '=', $key)
                    ->update(['value' => $value]);
            }

//            if($updated == 0) {
//                KeywordItem::create(['keyword_id' => $keyword->id, 'name' => 'title', 'value' => $data['title']]);
//            }
        }
//        else {
//            $keyword = Keyword::create($data);
//            foreach($data as $name => $value) {
//                if($name == 'type' || $name == 'id') {
//                    continue;
//                }
//                KeywordItem::create([
//                    'name' => $name,
//                    'value' => $value,
//                    'keyword_id' => $keyword->id
//                ]);
//            }
//        }
        $data = [
            'keywordList' => $data = Keyword::getGlobalData()
        ];
        return redirect('admin/settings/constants/')->with('data', $data);
    }

    /**
     * @param $globalData
     * @return array
     */
    private function getMasterKeys($globalData)
    {
        $masterKeys = [];
        foreach ($globalData as $key => $values) {
            if (isset($masterKeys[$key])) {
                continue;
            }
            $sampleValue = reset($values);
            $itemKeys = array_keys($sampleValue);
            $first = ['id'];
            $itemKeys = array_merge($first, $itemKeys);
            if(in_array('subcategory', $itemKeys) && in_array('title', $itemKeys)) {
                if (($valueToDelete = array_search('title', $itemKeys)) !== false) {
                    unset($itemKeys[$valueToDelete]);
                }
            }
            $masterKeys[$key] = $itemKeys;
        }
        return $masterKeys;
    }
}
