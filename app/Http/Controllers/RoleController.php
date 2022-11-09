<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

		 //$this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['roles/index','roles/store']]);
         //$this->middleware('permission:role-create', ['only' => ['roles/create','roles/store']]);
         //$this->middleware('permission:role-edit', ['only' => ['roles/edit','roles/update']]);
         //$this->middleware('permission:role-delete', ['only' => ['roles/destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 
		$roles = Role::orderBy('id','DESC')->paginate(50);
        return view('gwc.roles.index',compact('roles'))
               ->with('i', ($request->input('page', 1) - 1) * 50);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

		$permission = Permission::get();
        return view('gwc.roles.create',compact('permission'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);


        $role = Role::create(['guard_name' =>'admin','name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        //save logs
		$key_name   = "role";
		$key_id     = $role->id;
		$message    = "New Role is created as  ".$request->input('name');
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs
		
        return redirect("/gwc/roles")->back()
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();


        return view('gwc.roles.show',compact('role','rolePermissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
	    $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        //save logs
		$key_name   = "role";
		$key_id     = $role->id;
		$message    = "Role is edited to ".$role->name;
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs

        return view('gwc.roles.edit',compact('role','permission','rolePermissions'));
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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
		$role->guard_name = "admin";
        $role->save();


        $role->syncPermissions($request->input('permission'));
        //save logs
		$key_name   = "role";
		$key_id     = $role->id;
		$message    = "Role name is updated to ".$request->input('name');
		$created_by = Auth::guard('admin')->user()->id;
		Common::saveLogs($key_name,$key_id,$message,$created_by);
		//end save logs

        return redirect()->back()
                        ->with('message-success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->back()
                        ->with('message-success','Role deleted successfully');
    }
}
