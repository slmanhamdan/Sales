<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Admin_panel_settings;
use App\Http\Controllers\Admin\TreasuriesController;


define('Pagination_count',5);


Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'auth:admin'],function(){
    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
    // Route::get('logout',function(){
    //     auth()->logout();
    // });
    Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');
    Route::get('adminpanelsetting/index',[Admin_panel_settings::class,'index'])->name('admin.adminPanelSetting.index');
    Route::get('adminpanelsetting/edit',[Admin_panel_settings::class,'edit'])->name('admin.adminPanelSetting.edit');
    Route::Post('adminpanelsetting/update',[Admin_panel_settings::class,'update'])->name('admin.adminPanelSetting.update');
        /*                          tresures                         */
    Route::get('treasuriesController/index',[TreasuriesController::class,'index'])->name('admin.treasuries.index');
    Route::post('treasuries/ajax_search',[TreasuriesController::class,'ajax_search'])->name('admin.treasuries.ajax_search');
    Route::get('treasuriesController/create',[TreasuriesController::class,'create'])->name('admin.treasuries.create');
    Route::get('treasuriesController/edit/{id}',[TreasuriesController::class,'edit'])->name('admin.treasuries.edit');
    Route::get('treasuriesController/details',[TreasuriesController::class,'details'])->name('admin.treasuries.details');
    Route::post('treasuriesController/store',[TreasuriesController::class,'store'])->name('admin.treasuries.store');
    Route::put('treasuriesController/update/{id}',[TreasuriesController::class,'update'])->name('admin.treasuries.update');





    });
    



Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'guest:admin'],function(){
Route::get('login',[LoginController::class,'show_login_view'])->name('admin.showlogin');
Route::post('login',[LoginController::class,'login'])->name('admin.login');

});
