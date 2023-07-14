<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Ad;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('dashboard.categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('category_id',null)->get();

        return view('dashboard.categories.create',['categories'=>$categories]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $checkExistName = Category::where('name' , $request->name)->get();
        $checkExistName =  $checkExistName->ToArray();
        if($checkExistName){
            // check if same name category in same level
            foreach($checkExistName as $cat){
            if($cat['category_id']==$request->category_id)
            return redirect()->back()->withErrors(['message' => 'Name is already exist for another category']);
        }
    }

         $request->validate([
            'name' => 'required|max:255',
            'max_number_free_ads' => 'required',
            'free_ads_days' => 'required',

        ]);


       $id =  Category::create($request->all())->id;
       $is_child = $request->category_id;

       if($is_child)
            return redirect()->route('add-attribute' , $id);
        else
            return redirect()->route('categories.index')->with('success','Category Added successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $category = Category::where('id',$id)->with('attributes','packages')->first();
        $category = $category->ToArray();
//dd($category);
        if($category['category_id']){
            $parent =  Category::find($category['category_id']);//->name;
            $category['parent']=$parent['name'];
        }
        else
        $category['parent'] = null;
        return view('dashboard.categories.show',['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $categories = Category::where('category_id',null)->get();
        $category = Category::where('id',$id)->with('attributes','packages')->first();

        if($category->category_id){
            $parent =  Category::find($category->category_id);
            $category = $category->ToArray();
            $category['parent_name']=$parent->name;
            $category['parent_id']=$parent->id;
        }

      //  dd($category);
        return view('dashboard.categories.edit',['category'=>$category ,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $checkExistName = Category::where('name' , $request->name)->where('id' ,'<>' ,$request->idx)->get();
        $checkExistName =  $checkExistName->ToArray();

        if($checkExistName){
            // check if same name category in same level
            foreach($checkExistName as $cat){

            if($cat['category_id']==$request->category_id)
            return redirect()->back()->withErrors(['message' => 'Name is already exist for another category']);
        }
    }
        $request->validate([
            'name' => 'required|max:255',
            'max_number_free_ads' => 'required',
            'free_ads_days' => 'required',

        ]);
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index')
        ->with('success','Category Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        Category::where('category_id',$id)->update(['category_id'=>NULL]);
        return redirect()->route('categories.index')
                        ->with('success','Category deleted successfully');
    }


    static public function parent_name($id){
        $cat = Category::where('id',$id)->with('parent')->first();
        $data = $cat->toArray();
        return $data;
    }


    public function get_all_parents(){
        $parents = Category::where('category_id',null)->get();
        return $parents;
    }
    static public function get_all_child(){
        $child = Category::where('category_id',!null)->get();
        return $child;
    }

    public function get_child($parent_id){
        $child = Category::where('category_id',$parent_id)->get();
        return $child;
    }


}
