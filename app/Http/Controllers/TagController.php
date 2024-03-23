<?php

namespace App\Http\Controllers;

use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    function tags(){
        $maintag = tag::paginate(10);
        return view('admin.Tags.tags', [
            'tags' => $maintag,
        ]);
    }

    function tags_store(Request $request){
        $request->validate([
            "tag_name.*" => ['required', Rule::unique('tags','tag_name')],
        ], [
            'tag_name.*.required' => 'Please Insert Your Tag',
            'tag_name.*.unique' => 'Your Tag Is Already Exite',

        ]);


        $tags = $request->tag_name;
        foreach($tags as $tag){
            tag::insert([
                'tag_name'=> $tag,
                'created_at'=> Carbon::now(),
            ]);
        }
        return back()->with('success', 'Your Tag Successfully Add');
    }

    function tags_delete($id){
        tag::find($id)->delete();

        return back()->with('success-del', 'Your Tag Has Been Deleted');
    }
}
