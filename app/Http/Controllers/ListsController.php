<?php

namespace App\Http\Controllers;

use App\Models\Cards;
use App\Models\Lists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Nullable;

class ListsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $lists = Lists::where('user_id', $user->id)->get();

        return view('lists', ['lists' => $lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        switch($user->subscription->name_subscription) {
            case('BASIC'):
                $maxLists = 3;
                break;
            case('IMPROVER'):
                $maxLists = 5;
                break;
            case('PREMIUM'):
                $maxLists = 10;
                break;
        }

        if (Lists::where('user_id', $user->id)->count() >= $maxLists) {
            return response()->json([
                'status' => 'Please, update your subscription. You can have only ' . $maxLists . ' lists now.',
            ], 400);
        }

        return Lists::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        
        $list = Lists::where([['user_id', $user->id], ['id', $id]])->first();

        $cards = Cards::where('list_id', $id)->get();
        
        if (!empty($list->user_id))
            return view('list', ['list' => $list, 'cards' => $cards]);
        else 
            return redirect('/access-denied');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        Lists::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lists::find($id)->delete();
    }
}
