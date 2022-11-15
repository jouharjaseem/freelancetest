<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commenmodel;
class Category extends Controller
{
    public $db;
    function __construct()
    {
        $this->db =  new Commenmodel();
    }
    function index()
    {
        return view('welcome');
    }
    function main(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required',
               
            ]);

            $main = trim(strip_tags($request->input('name')));
            $check = $this->db->get_selected_data('id', 'category', ['name,=' => $main,'master_id,=' =>0,"sub_master_id,="=>0]);
            if (empty($check)) {
                $data_val = [
                    "name" => $main,
                    "created_at" => date('Y-m-d'),
                    "master_id"=>0,
                    "sub_master_id"=>0
                    
                   
                ];
                $this->db->insert_data('category', $data_val);
                $request->session()->flash('success', 'Saved successfully!');
                return redirect('main');
            } else {
                $request->session()->flash('error', 'This category is already exists');
            }
        }
        $data['result'] = $this->db->get_selected_data('id,name', 'category', ['master_id,=' =>0,"sub_master_id,="=>0]);
         
        return view('main',$data);
    }
    function mainedit(Request $request,int $id)
    {
       
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required',
               
            ]);

            $main = trim(strip_tags($request->input('name')));
            $check = $this->db->get_selected_data('id', 'category', ['name,=' => $main,'master_id,=' =>0,"sub_master_id,="=>0,"id,!="=>$id]);
            if (empty($check)) {
                $data_val = [
                    "name" => $main,
                    "created_at" => date('Y-m-d'),
                    "master_id"=>0,
                    "sub_master_id"=>0
                    
                   
                ];
                $this->db->update_data('category',["id,="=>$id],$data_val);
                $request->session()->flash('success', 'Saved successfully!');
                return redirect('main');
            } else {
                $request->session()->flash('error', 'This category is already exists');
            }
        }
        $data['result'] = $this->db->get_selected_data('id,name', 'category', ['master_id,=' =>0,"sub_master_id,="=>0,"id,="=>$id]);
         
        return view('mainedit',$data);
    }
    function subcate(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required',
                'cate_id' => 'required',
            ]);

            $main = trim(strip_tags($request->input('name')));
            $cate_id = trim(strip_tags($request->input('cate_id')));
           
            $check = $this->db->get_selected_data('id', 'category', ['name,=' => $main,'master_id,=' =>$cate_id,"sub_master_id,="=>0]);
            if (empty($check)) {
                
                $data_val = [
                    "name" => $main,
                    "created_at" => date('Y-m-d'),
                    "master_id"=> $cate_id ,
                    "sub_master_id"=>0
                    
                   
                ];
                $this->db->insert_data('category', $data_val);
                $request->session()->flash('success', 'Saved successfully!');
                return redirect('subcate');
            } else {
                $request->session()->flash('error', 'This category is already exists');
            }
        }
        $data['category'] = $this->db->get_selected_data('id,name', 'category', ['master_id,=' =>0,"sub_master_id,="=>0]);
        $data['result'] = $this->db->jointbl('a.id,a.name,b.name as main', 'category as a',["category as b,b.id,=,a.master_id"],['a.master_id,!=' =>0,"a.sub_master_id,="=>0]);
     
        return view('subcate',$data);
    }
    function subedit(Request $request,int $id)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required',
                'cate_id' => 'required',
            ]);

            $main = trim(strip_tags($request->input('name')));
            $cate_id = trim(strip_tags($request->input('cate_id')));
           
            $check = $this->db->get_selected_data('id', 'category', ['name,=' => $main,'master_id,=' =>$cate_id,"sub_master_id,="=>0,"id,!="=>$id]);
            if (empty($check)) {
                
                $data_val = [
                    "name" => $main,
                    "updated_at" => date('Y-m-d'),
                    "master_id"=> $cate_id ,
                    "sub_master_id"=>0
                    
                   
                ];
                $this->db->update_data('category', ["id,="=>$id],$data_val);
                $request->session()->flash('success', 'Saved successfully!');
                return redirect('subcate');
            } else {
                $request->session()->flash('error', 'This category is already exists');
            }
        }
        $data['category'] = $this->db->get_selected_data('id,name', 'category', ['master_id,=' =>0,"sub_master_id,="=>0]);
        $data['result'] = $this->db->get_selected_data('id,name,master_id', 'category', ['master_id,!=' =>0,"sub_master_id,="=>0,"id,="=>$id]);
      
       
        return view('subcateedit',$data);
    }
    function subsubcate(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required',
                'cate_id' => 'required',
                'sub'=> 'required',
            ]);
            $sub = trim(strip_tags($request->input('sub')));
            $main = trim(strip_tags($request->input('name')));
            $cate_id = trim(strip_tags($request->input('cate_id')));
           
            $check = $this->db->get_selected_data('id', 'category', ['name,=' => $main,'master_id,=' =>$cate_id,"sub_master_id,="=>$sub]);
            if (empty($check)) {
                
                $data_val = [
                    "name" => $main,
                    "created_at" => date('Y-m-d'),
                    "master_id"=> $cate_id ,
                    "sub_master_id"=>$sub
                    
                   
                ];
                $this->db->insert_data('category', $data_val);
                $request->session()->flash('success', 'Saved successfully!');
                return redirect('subsubcate');
            } else {
                $request->session()->flash('error', 'This category is already exists');
            }
        }
        $data['category'] = $this->db->get_selected_data('id,name', 'category', ['master_id,=' =>0,"sub_master_id,="=>0]);
        $data['result'] = $this->db->jointbl('a.id,a.name,b.name as main,c.name as sub', 'category as a',["category as b,b.id,=,a.master_id","category as c,c.id,=,a.sub_master_id"],['a.master_id,!=' =>0,"a.sub_master_id,!="=>0]);
     
        return view('subsubcate',$data);
    }
    function subsubedit(Request $request,int $id)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required',
                'cate_id' => 'required',
                'sub'=> 'required',
            ]);
            $sub = trim(strip_tags($request->input('sub')));
            $main = trim(strip_tags($request->input('name')));
            $cate_id = trim(strip_tags($request->input('cate_id')));
           
         
            $check = $this->db->get_selected_data('id', 'category', ['name,=' => $main,'master_id,=' =>$cate_id,"sub_master_id,="=>$sub,"id,!="=>$id]);
            if (empty($check)) {
                
                $data_val = [
                    "name" => $main,
                    "updated_at" => date('Y-m-d'),
                    "master_id"=> $cate_id ,
                    "sub_master_id"=>$sub
                    
                   
                ];
                $this->db->update_data('category', ["id,="=>$id],$data_val);
                $request->session()->flash('success', 'Saved successfully!');
                return redirect('subsubcate');
            } else {
                $request->session()->flash('error', 'This category is already exists');
            }
        }
        $data['category'] = $this->db->get_selected_data('id,name', 'category', ['master_id,=' =>0,"sub_master_id,="=>0]);
        $data['result'] = $this->db->get_selected_data('id,name,master_id,sub_master_id', 'category', ['master_id,!=' =>0,"sub_master_id,!="=>0,"id,="=>$id]);
      
       
        return view('subsubcateedit',$data);
    }
    function getcate(Request $request)
    {
        $id = $request->input('id');
        $result = $this->db->get_selected_data('id,name', 'category', ['master_id,=' =>$id,"sub_master_id,="=>0]);
        echo json_encode($result);
    }
    function getsubcate(Request $request)
    {
        $id = $request->input('id');
        $main = $request->input('main');
        $result = $this->db->get_selected_data('id,name', 'category', ['master_id,=' =>$main,"sub_master_id,="=>$id]);
        echo json_encode($result);
    }
    function product(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required',
                'cate_id' => 'required',
                'sub'=> 'required',
                'subsub'=> 'required',
            ]);
            $sub = trim(strip_tags($request->input('sub')));
            $subsub = trim(strip_tags($request->input('subsub')));
            $main = trim(strip_tags($request->input('name')));
            $cate_id = trim(strip_tags($request->input('cate_id')));
           
            $check = $this->db->get_selected_data('id', 'product', ['name,=' => $main,'cate_id,=' =>$cate_id,"sub_cate_id,="=>$sub,"sub_sub_cate_id,="=>$subsub]);
            if (empty($check)) {
                
                $data_val = [
                    "name" => $main,
                    "created_at" => date('Y-m-d'),
                    "cate_id"=> $cate_id ,
                    "sub_cate_id"=>$sub,
                    "sub_sub_cate_id"=>$subsub
                   
                ];
                $this->db->insert_data('product', $data_val);
                $request->session()->flash('success', 'Saved successfully!');
                return redirect('product');
            } else {
                $request->session()->flash('error', 'This product is already exists');
            }
        }
        $data['category'] = $this->db->get_selected_data('id,name', 'category', ['master_id,=' =>0,"sub_master_id,="=>0]);
        $data['result'] = $this->db->jointbl('a.id,a.name,b.name as main,c.name as sub,d.name as subsub', 'product as a',["category as b,b.id,=,a.cate_id","category as c,c.id,=,a.sub_cate_id","category as d,d.id,=,a.sub_sub_cate_id"],[]);
        $data['db'] = $this->db;
        $data['url'] = url('');
        return view('product',$data);
    }
}
