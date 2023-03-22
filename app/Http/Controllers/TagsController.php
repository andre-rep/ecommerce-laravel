<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    public function add()
    {
        //Retrieve data from the user
        $tagName = request()->tagsName;

        //Insert a new tag
        DB::table('tags')->insert([
            'tag_name' => $tagName
        ]);

        return "Nova tag adicionada";
    }
}
