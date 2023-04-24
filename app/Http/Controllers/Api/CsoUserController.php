<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CsoUserResource;
use App\Models\CsoUser;

class CsoUserController extends Controller
{
    public function create()
    {
        //
    }

    public function store(Request $request, $uuid)
    {
        $user = CsoUser::where('uuid', $uuid)->first();
        if($user == null) $user = new CsoUser;
        $user->uuid         = $uuid;
        $user->division     = $request->get('division');
        $user->occupication = $request->get('occupication');
        $user->gender       = $request->get('gender');
        $user->age          = $request->get('age');
        $user->ethnicity    = $request->get('ethnicity');
        $user->save();
        return new CsoUserResource($user);
    }

    public function show($uuid)
    {
        $user = CsoUser::where('uuid', $uuid)->firstOrFail();
        return new CsoUserResource($user);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
