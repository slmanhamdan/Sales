@extends('layouts.admin')
@section('title')
    تعديل الضبط العام
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('contentheader')
    الضبط
@endsection

@section('contentheaderlink')
    <a href="{{ route('admin.adminPanelSetting.index') }}"> الضبط </a>
@endsection

@section('contentheaderactive')
    تعديل
@endsection



@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center">تعديل بيانات الضبط العام</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (@isset($data) && !empty($data))
                <form action="{{ route('admin.adminPanelSetting.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>اسم الشركه</label>
                        <input type="text" name="system_name" id="system-name" class="form-control"
                           value ="{{ $data['system_name'] }}" placeholder="ادخل اسم الشركه"
                            oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')"
                            onchange="try{setCustomValidity('')}catch(e){}">
                    </div>
                    @error('system_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label>عنوان الشركه</label>
                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ $data['address'] }}" placeholder="ادخل اسم الشركه"
                            oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')"
                            onchange="try{setCustomValidity('')}catch(e){}">
                    </div>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label>هاتف الشركه</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ $data['phone'] }}" placeholder="ادخل اسم الشركه"
                            oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')"
                            onchange="try{setCustomValidity('')}catch(e){}">
                    </div>
                    <div class="form-group">
                        <label> رسالة تنبيه اعلى الشاشة</label>
                        <input type="text" name="general_alert" id="general_alert" class="form-control"
                            value="{{ $data['general_alert'] }}" placeholder="ادخل اسم الشركه"
                            oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')"
                            onchange="try{setCustomValidity('')}catch(e){}">
                    </div>
                    <div class="form-group">
                        <label> شعار الشركة</label>
                        <div class="image">
                            <img class="custom_img" src="{{ asset('Assets/admin/uploads') . '/' . $data['photo'] }}"
                                alt="لوجو الشركة">
                            <button type="button" class="btn btn-sm btn-danger" id="update_image">تغير الصورة</button>
                            <button type="button" class="btn btn-sm btn-danger" style="display: none;"
                                id="cancel_update_image"> الغاء</button>
                        </div>

                        <div id="oldimage">

                        </div>

                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-sm">حفظ التعديلات</button>
                    </div>

        </div>
        </form>
    @else
        @endif
    @endsection
