<?php

namespace EmejiasInventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\People;
use EmejiasInventory\Http\Resources\PeopleResource;
use EmejiasInventory\Http\Requests\PeopleStore;
use EmejiasInventory\Http\Requests\PeopleUpdate;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $people = People::search()->orderByDesc('id')->paginateIf();
        return PeopleResource::collection($people);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleStore $request)
    {
        $people = People::create(request()->all());
        return new PeopleResource($people);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(People $person)
    {
        return new PeopleResource($person);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PeopleUpdate $request, People $person)
    {
        $person->update(request()->all());
        return new PeopleResource($person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $person)
    {
        $person->delete();
        return response()->json([], 204);
    }
}
