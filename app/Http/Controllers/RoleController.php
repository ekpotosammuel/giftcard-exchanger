<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::get();
        return response()->json([
            'Message' => 'All Roles',
            'data'    => $role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        $role = new Role();
        $role->name = $request->input('name');
        $role->save();
        return response()->json([
            'Message' => 'Role Successfully Added',
            'Data'    => $role
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role, $id)
    {
        $role = Role::findorFail($id);
        return response()->json([
            'Message' => 'Fetch One',
            'data'    => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role, $id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $role = Role::findorFail($id);
        $role->name = $request->input('name');
        $role->save();
        return response()->json([
            'Message'   => 'Role Created Successfully',
            'data'      => $role
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
