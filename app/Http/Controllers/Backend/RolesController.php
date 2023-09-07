<?php

namespace App\Http\Controllers\Backend;

use App\Acl\AccessControl;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

class RolesController extends BackendController
{
    public function __construct()
    {
        $this->route_prefix = $this->view_prefix = "roles";
    }

    public function index()
    {
        $modelName = "Role";

        $conditions = $this->getConditions(Route::currentRouteName(), [
            ["field" => "name", "type" => "string", "view_field" => "name"],            
        ]);

        //dd($conditions);
        $records = Role::where($conditions)->paginate(PAGINATION_LIMIT);

        $this->setForView(compact("records", "modelName"));

        return $this->view("index");
    }

    public function create()
    {
        $model = new Role();

        $this->setForView(compact("model"));

        return $this->view("add");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([            
            'name' => 'required|min:3|unique:roles'
        ]);
  
        Role::create($validatedData);
            
        return back()->with('success', 'Record created successfully');
    }

    public function edit($id)
    {
        $model = Role::findOrFail($id);

        $this->setForView(compact("model"));

        return $this->view("edit");
    }

    public function update($id, Request $request)
    {
        $model = Role::findOrFail($id);

        $validatedData = $request->validate([            
            'name' => 'required|min:3|unique:roles,name,' . $model->id      
        ]);

        $model->fill($validatedData);
        $model->save();

        return redirect()->route($this->route_prefix . ".index")->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return back()->with('success', 'Record deleted successfully.');
    }
}