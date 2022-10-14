<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;


class RolesController extends Controller
{
    
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('roles')) {
            
            session()->flash('error','Sorry !! You are Unauthorized  !');
           
        }
        $roles=Role::all();
        return view('admin.roles.index',[
            'roles'=>$roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('roles/create')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $permissions= Permission::all();
        $permission_groups=User::getPermissionGroups();
        return view('admin.roles.create',[
            'permissions'=>$permissions,
            'permission_groups'=>$permission_groups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('roles/create')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $request->validate([
            'name' => 'required|max:100|unique:roles',
        ]);
        $role=Role::create(['name'=>$request->name,'guard_name'=>'admin']);
        $permissions=$request->input('permissions');
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        Alert::success('Success','Role has been added successfully!');
        return redirect()->route('roles.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('roles/edit')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $role=Role::findById($id);
        $permissions= Permission::all();
        $permission_groups=User::getPermissionGroups();
        return view('admin.roles.edit',[
            'role'=>$role,
            'all_permissions'=>$permissions,
            'permission_groups'=>$permission_groups,
        ]);
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
        if (is_null($this->user) || !$this->user->can('roles/edit')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,'.$id,
        ]);
        $role=Role::findById($id);
        $role->name=$request->name;
        $role->save();
        $permissions=$request->input('permissions');
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        else{
            $role->syncPermissions([]);

        }
        Alert::success('Success','Role has been updated successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('roles/delete')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $role=Role::findById($id);
        $role->delete();
        return back();
    }

    
}
