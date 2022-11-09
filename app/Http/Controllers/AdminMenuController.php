<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Auth;
use App\Menus;
///use session;


class AdminMenuController extends Controller
{
   
    public function __construct()
    {
        //$this->middleware('guest:admin');
    }
     
    public function index(Request $request)
    {
       
        //check search queries
        if(!empty($request->get('q'))){
        $q = $request->get('q');
        }else{
        $q = $request->q;
        }
        
       
        //menus records
        if(!empty($q)){
        $menusLists = Menus::where('parent_id',0)->where('name','LIKE','%'.$q.'%')
                            ->orderBy('display_order', 'ASC')
                            ->paginate(50);  
        $menusLists->appends(['q' => $q]);
		
        }else{
        $menusLists = Menus::where('parent_id',0)->orderBy('display_order', 'ASC')->paginate(50);
        }
        return view('gwc.adminMenus',['menusLists' => $menusLists]);
    }

    public function adminMenusForm($id="",Request $request){

        if(!empty($id)){
        $menusDetails = Menus::where('id',$id)->first(); 
        }else{
        $menusDetails=array();
        }
        //
        $menuDropDownList = Menus::where('parent_id',0)->orderBy('display_order', 'ASC')->paginate(1000);
        return view('gwc.adminMenusForm',['menusDetails'=>$menusDetails,'menuDropDownList'=>$menuDropDownList]);
    }

    public function AddRecord(Request $request){
        
        //manage menus add/edit
        if(!empty($request->parent_id)){
        $parent_id = $request->parent_id;
        }else{
        $parent_id = 0;
        }
        if(!empty($request->id)){
        $Menu = Menus::findOrFail($request->id);
        $Menu->name = $request->name;
        $Menu->link = $request->link;
        $Menu->icon = $request->icon;
        $Menu->display_order = $request->display_order;
        $Menu->parent_id = $parent_id;
        $Menu->updated_at = date("Y-m-d H:i:s");
        $Menu->save();
        Session::flash('message-success','Record is updated successfully.');
        }else{
		$Menu = new Menus;
        $Menu->name = $request->name;
        $Menu->link = $request->link;
        $Menu->icon = $request->icon;
        $Menu->display_order = $request->display_order;
        $Menu->parent_id = $parent_id;
        $Menu->created_at = date("Y-m-d H:i:s");
        $Menu->updated_at = date("Y-m-d H:i:s");
        $Menu->save();
        Session::flash('message-success','Record is added successfully.');
        }
        
        return redirect("/gwc/menus");
    }

    public function deleteMenus($id=0){
     if(!empty($id)){
        $men=Menus::where("id",$id)->first();
		if(!empty($men->submenu)){
		foreach ($men->submenu as $sub)
            {
                $sub->delete($sub->id);
            }
	    }		
        $men->delete($men->id);
        Session::flash('message-success','Record is deleted successfully.');
     }else{
        Session::flash('message-error','Failed to delete');
     }
     return redirect()->back();
    }

   //update status
	public function updateStatusAjax(Request $request)
    {
		$recDetails = Menus::where('id',$request->id)->first(); 
		if($recDetails['is_active']==1){
			$active=0;
		}else{
			$active=1;
		}
		$recDetails->is_active=$active;
		$recDetails->save();
		return ['status'=>200,'message'=>'Status is modified successfully'];
	}
	
	
    //get parent menus in dropdonwn
    /*static public function getLeftMenu(){
	$Menu =new Menus;
    $allCategories=$Menu->tree();  
	return $allCategories;
	}*/
}
