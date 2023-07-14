<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = DB::table('attributes')
            ->where('category_id', '=', 1)
            ->get();
        return view('dashboard.attributes.show', ['attributes' => $attributes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.attributes.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // add your error messages:
        $request->validate([
            'name' => 'required|array',
        ]);
        if ($request->name[0] == null) {
            return view('dashboard.attributes.create')->withErrors(["name" => "attribute name is requaird"]);
        }
        $names = [];
        $data = [];
        foreach ($request->name as $name) {
            if (in_array($name, $names)) {
                continue;
            } else {
                $names[] = $name;
            }
        }
        foreach ($names as $name) {
            $data[] = [
                'name' => $name,
                'category_id' => $request->category_id,
            ];
        }
        Attribute::insert($data);
        return redirect()->route('categories.show',['category'=>$request->category_id]);

        //  return view('home')->with('catiegories',catiegory::all())->with('jobs',job::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = Attribute::find($id);
        return view('dashboard.attributes.update', ['attribute' => $attribute]);
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

        $request->validate([
            'name' => 'required|string',
        ]);
        $attribute=Attribute::find($id);
        $category_id=$attribute->category_id;
        Attribute::whereId($id)->update(['name' => $request->name]);
        return redirect()->route('categories.show',['category'=>$category_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Attribute::find($id); //search with id only in table
        if (!$attribute) {
            return redirect()->back()->with('success', 'the attribute deleted successfully');
        }
        $attribute=Attribute::find($id);
        $category_id=$attribute->category_id;
        $attribute->delete();
        return redirect()->route('categories.show',['category'=>$category_id]);
    }
    public function create2($categoryID)
    {
        return view('dashboard.attributes.create', ['category_id' => $categoryID]);
    }
}