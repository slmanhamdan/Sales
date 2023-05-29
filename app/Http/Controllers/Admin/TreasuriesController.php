<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TreasuriesRequest;
use App\Models\Treasuries;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class TreasuriesController extends Controller
{
public function index(){
    $data = Treasuries::select()->orderby('id','desc')->paginate(Pagination_count);
    return view('admin.treasures.index',['data'=> $data]);
    }

public function ajax_search(Request $request){
if($request->ajax()){
    $search_by_text=$request->search_by_text;
    $data=Treasuries::where('name','LIKE',"%{$search_by_text}%")->orderBy('id','DESC')->paginate(Pagination_count);
    return view('admin.treasures.ajax_search',['data'=>$data]);    
    }
}

public function create(){
    return view('admin.treasures.create');
}
public function store(TreasuriesRequest $request){
    try{
        $com_code=auth()->user()->com_code;
        //check if not exsits
        $checkExists=Treasuries::where(['name'=>$request->name,'com_code'=>$com_code])->first();
        if($checkExists==null){
        if($request->is_master==1){
        $checkExists_isMaster=Treasuries::where(['is_master'=>1,'com_code'=>$com_code])->first();
        if($checkExists_isMaster!=null){
        return redirect()->back()
        ->with(['error'=>'عفوا هناك خزنة رئيسية بالفعل مسجلة من قبل لايمكن ان يكون هناك اكثر من خزنة رئيسية'])
        ->withInput(); }
        }
        $treasuries = new Treasuries();
        $treasuries->name = $request->name;
        $treasuries->is_master = $request->is_master;
        $treasuries->last_isal_exhcange = $request->last_isal_exhcange;
        $treasuries->last_isal_collect = $request->last_isal_collect;

        $treasuries->active = $request->active;

        $treasuries->created_at = date("Y-m-d H:i:s");

        $treasuries->added_by = auth()->user()->id;
        $treasuries->com_code = $com_code;
        $treasuries->date = date("Y-m-d");
        $treasuries->save();
        return redirect()->route('admin.treasuries.index')->with(['success'=>'لقد تم اضافة البيانات بنجاح']);
        }else{
        return redirect()->back()
        ->with(['error'=>'عفوا اسم الخزنة مسجل من قبل'])
        ->withInput(); 
        }
        }catch(\Exception $ex){
        return redirect()->back()
        ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
        ->withInput();           
        }
}
public function edit($id){
    $data=Treasuries::where('id', $id)->first();
    return view('admin.treasures.edit',['data'=>$data]);

}
public function details(){
    
}

public function update($id,TreasuriesRequest $request){
try{
        $com_code=auth()->user()->com_code;
        $data=Treasuries::select()->find($id);
        if(empty($data)){
        return redirect()->route('admin.treasuries.index')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
        }
        $checkExists=Treasuries::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();
        if( $checkExists!=null){
        return redirect()->back()
        ->with(['error'=>'عفوا اسم الخزنة مسجل من قبل'])
        ->withInput(); 
        }
        if($request->is_master==1){
        $checkExists_isMaster=Treasuries::where(['is_master'=>1,'com_code'=>$com_code])->where('id','!=',$id)->first();
        if($checkExists_isMaster!=null){
        return redirect()->back()
        ->with(['error'=>'عفوا هناك خزنة رئيسية بالفعل مسجلة من قبل لايمكن ان يكون هناك اكثر من خزنة رئيسية'])
        ->withInput(); 
        }
        }

        $data->name = $request->name;
        $data->is_master = $request->is_master;
        $data->last_isal_exhcange = $request->last_isal_exhcange;
        $data->last_isal_collect = $request->last_isal_collect;

        $data->active = $request->active;

        $data->created_at = date("Y-m-d H:i:s");

        $data->added_by = auth()->user()->id;
        $data->com_code = $com_code;
        $data->date = date("Y-m-d");
        $data->save();
        return redirect()->route('admin.treasuries.index')->with(['success'=>'لقد تم تحديث البيانات بنجاح']);
        }catch(\Exception $ex){
        return redirect()->back()
        ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
        ->withInput();           
        }
}    
}
