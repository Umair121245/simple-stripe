<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Helper;
use Auth;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::where('is_deleted' , 0)->get();
        return view('brands.index',compact('brands'));
    }
   
    public function create()
    {
        $user = Auth::user();
        return view('brands.create')->with(compact('user'));
    }
  
    public function store(Request $request)
    {
        if ($request->file('upload') != '') {
            $path_a = ($request->file('upload'))->store('uploads/brand/'.md5(Str::random(20)), 'public');
            $_POST['upload'] = $path_a;
        }
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        
        try{
            Brand::insert($post_feilds);
            return redirect()->route('brand.index')
                        ->with('success','Brands created successfully');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Error will saving record');
        }
    }
   
    public function show(Brand $brand)
    {
        return view('brands.create',compact('brand'));
    }
   
    public function edit($id)
    {
        $brand = Brand::where('is_active' , 1)->where('is_deleted' , 0)->where('id' , $id)->first();
        if($brand){
            return view('brands.create',compact('brand'));
        }else{
            return redirect()->back()->with('error', "No record Exist");
        }
        
    }

    public function update($id, Request $request)
    {

        $token_ignore = ['_token' => '' ];
        if ($request->file('upload') != '') {
            $path_a = ($request->file('upload'))->store('uploads/brand/'.md5(Str::random(20)), 'public');
            $_POST['upload'] = $path_a;
        }
        $post_feilds = array_diff_key($_POST , $token_ignore);

        $brand = Brand::where('is_active' , 1)->where('is_deleted' , 0)->where('id' , $id)->first();

        try {
            $brand->update($post_feilds);
            
            return redirect()->route('brand.index')
                        ->with('success','Brand updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the brand. Please try again later.');
        }
    }
  
    public function destroy($id)
    {

        $brand = Brand::where('id' , $id)->first();
        $brand->is_active = 0;
        $brand->is_deleted = 1;
        $brand->save();
        return redirect()->route('brand.index')
                        ->with('success','Brand deleted successfully');
    }

}
