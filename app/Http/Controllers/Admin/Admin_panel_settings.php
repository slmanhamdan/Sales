<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin_panel_settings as ModelsAdmin_panel_settings;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Admin_panel_sett_Request;
class Admin_panel_settings extends Controller
{
    public function index(){
        $data =ModelsAdmin_panel_settings::where('com_code',auth()->user()->com_code)->first();
        if(!empty($data)){
            if($data['updated_by'] and $data['updated_by']!=null){
                $data['updated_by_admin']=Admin::where('id',$data['updated_by'])->value('name');
            }
        return view('admin.admin_panel_settings.index',['data'=>$data]);    
            
        }
   }
   public function edit(){
        $data =ModelsAdmin_panel_settings::where('com_code',auth()->user()->com_code)->first();
        return view ('admin.admin_panel_settings.edit',['data'=>$data]);
   }
   public function update(Admin_panel_sett_Request $request){
    try{
        $data =ModelsAdmin_panel_settings::where('com_code',auth()->user()->com_code)->first();
        $data->system_name = $request->system_name;
        $data->address=$request->address;
        $data->phone=$request->phone;
        $data->general_alert=$request->general_alert; 
        $data->updated_by =auth()->user()->id; 
        $data->updated_at = date('Y-m-d H:i:s');
        if($request->has('photo')){
            $request->validate([
                'photo'=>'required|mimes:png,jpg,jpeg|max:2000'
            ]);
            $file_name = uploadImage('Assets\admin\uploads',$request->photo);
            $data->photo = $file_name ;
        }

        $data->save();
        return redirect()->route('admin.adminPanelSetting.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        
    }catch(Exception $ex){
        return redirect()->route('admin.adminPanelSetting.index')->with(['error'=>'عفوا حدث خطأ ما '.$ex->getMessage()]);  
    }

   }
}

