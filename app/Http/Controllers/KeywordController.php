<?php

namespace App\Http\Controllers;

use App\EmissionFactor;
use App\Keyword;
use App\KeywordItem;
use Illuminate\Http\Request;
class KeywordController extends Controller
{
    public function index(Request $request)
    {
        $keywords = '';
        if($request->get('keywords') != '') {
            $keywords = $request->get('keywords');
        }

        $data = [
            'keywords' => $keywords,
            'keywordList' => $data = Keyword::getGlobalData($keywords)
        ];
        return view('admin.keywords.list', $data);
    }

    public function show($keywordId) {
        $keyword = Keyword::findOrFail($keywordId); /** @var Keyword $keyword*/
        $keywordData = $keyword->getData();
        $globalData = Keyword::getGlobalData();
        $data = [
            'keyword' => $keywordData,
            'keywordList' => $globalData,
        ];
        return view('admin.keywords.list', $data);
    }

    public function store(Request $request) {
        $data = $request->all();
        if(!empty($data['id'])) {
            $keyword = Keyword::findOrFail($data['id']); /** @var Keyword $keyword*/
            $updated = KeywordItem::where('keyword_id', '=', $keyword->id)
                ->where('name', '=', 'title')
                ->update(['value' => $data['title']]);
            if($updated == 0) {
                KeywordItem::create(['keyword_id' => $keyword->id, 'name' => 'title', 'value' => $data['title']]);
            }
        }
        else {
            $keyword = Keyword::create($data);
            foreach($data as $name => $value) {
                if(in_array($name, ['type', 'id', '_token'])) {
                    continue;
                }
                if(in_array($data['type'], array_keys(Keyword::$emissionFactorKeys))) {
                    $name = 'subcategory';
                }
                KeywordItem::create([
                    'name' => $name,
                    'value' => $value,
                    'keyword_id' => $keyword->id
                ]);
            }
            foreach(EmissionFactor::$keysToBeFilledByUser as $key) {
                if($key === 'subcategory') {
                    continue;
                }
                KeywordItem::create([
                    'name' => $key,
                    'value' => '',
                    'keyword_id' => $keyword->id
                ]);
            }
        }
        $data = [
            'keywordList' => $data = Keyword::getGlobalData()
        ];
        return redirect('admin/settings/keywords/')->with('data', $data);
    }
}
