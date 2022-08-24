<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestTest;

class TestTestController extends Controller
{
    //
    public function edit()
    {
        return view('testtest');
    }

    public function edit_post(Request $request)
    {
        $name = $request->name;
        $comment = $request->comment;

        TestTest::create([
            'name'=>$name,
            'comment'=>$comment,
        ]);

        $tests = TestTest::all();
        return view('testshow', compact('tests'));
    }

    public function show()
    {
        $tests = TestTest::all();
        return view('testshow', compact('tests'));
        
    }

    public function update(string $id)
    { 
        $tests = TestTest::find($id);
        return view('testupdate', compact('tests'));
        
    }

    public function update_post(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $comment = $request->comment;

        $tests = TestTest::where('id', $id)->update([
            'name' => $name,
            'comment' => $comment,
        ]);

        $tests = TestTest::find($id);
        return view('testupdate', compact('tests'));
        
    }

    public function delete(string $id)
    { 
        $tests = TestTest::find($id);
        return view('testdelete', compact('tests'));
        
    }

    public function delete_post(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $comment = $request->comment;

        $tests = TestTest::where('id', $id)->delete();

        $tests = TestTest::all();
        return view('testshow', compact('tests'));
        
    }



}
