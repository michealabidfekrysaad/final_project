<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeValue;
use App\Category;
use Illuminate\Http\Request;
use DB;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $category = Category::find(1);

        //$attribute = Attribute::with('categoryAttribute')->get();
        // dd($attribute);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function __construct()
    {
        $this->middleware(['role:Admin'])->only('store');
    }
    public function store(Request $request)
    {
        $category = Category::create([
            'category_name' => $request->category_name,
        ]);
        return response()->json($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function admincategory()
    {
        $categories = Category::all();
        // dd($users);
        return view('layouts.AdminPanel.category.index', ['categories' => $categories]);
    }

    public function createCategory()
    {

        return view('layouts.AdminPanel.category.create');
    }

    public function storeCategory(Request $request)
    {
        Category::create([
            'category_name' => $request->Category_name,
        ]);

        return redirect('/admin/panel/categorytable');
    }
    public function destroyCategory($id)
    {
        Category::find($id)->delete();
        return redirect('/admin/panel/categorytable');
    }
    // abdo function admin --------------------------------
    public function edit22Admin(Category $category)
    {
        $attributeOfCategory = $category->attributes;
        $attributes=Attribute::with('categoryAttribute')->get();
        return view('layouts.AdminPanel.categoryAdmin.edit', [
            'category'=>$category,
            'attributeOfCategory' => $attributeOfCategory,
            'attributes' => $attributes
        ]);
    }

    public function index22Admin()
    {
        $categories = Category::with('attributes')->get();
        return view('layouts.AdminPanel.categoryAdmin.index', ['categories' => $categories]);
    }

    public function create22Admin(Category $category)
    {
        $attributeOfCategory = $category->attributes;
        $attributes=Attribute::with('categoryAttribute')->get();
        return view('layouts.AdminPanel.categoryAdmin.create',[
            'attributeOfCategory'=>$attributeOfCategory
            ,'attributes'=>$attributes]);
    }

    public function stores22Admin(Request $request)
    {
        DB::transaction(function () use ($request) {
            $category = Category::create([
                    'category_name' => $request->input('category_name'),
                ]);

            $attribute = Attribute::create([
                    'attribute_name' => $request->input('attribute_name'),
                ]);

            $attribute_category = DB::table('attribute_category')
                ->insert([
                    'category_id' => $category->id,
                    'attribute_id' => $attribute->id
                ]);

            $value = DB::table('values_of_attributes')
                ->insert([
                    'value_name' => $request->input('value_name'),
                    'attribute_id' => $attribute->id
                ]);
        });
        return redirect()->route('category.index22Admin');
    }

    public function show22Admin($id)
    {
        $category = Category::with('attributes')->where('id', '=', $id)->get();
        return view('layouts.AdminPanel.categoryAdmin.show', ['category' => $category]);
    }

    public function createCategoryAdmin(Request $request)
    {
        DB::transaction(function () use ($request) {
            $category=Category::create([
                'category_name'=> $request->input('category')
                ]);

                foreach ($request->input('attribute') as $attribute){
                    $category->attributes()->attach($attribute);
            }
        });
        return redirect()->route('category.index22Admin');
    }


    public function update22Admin(Request $request, Category $category)
    {


        DB::transaction(function () use ($request, $category) {
            if( $request->has("category")){
                $category->category_name= $request->input('category');
                $category->save();
            }
            $category->attributes()->detach();
            if($request->has("attribute")){
                foreach ($request->input('attribute') as $attribute){
                    $category->attributes()->attach($attribute);
                }
            }
        });
        return redirect()->route('category.index22Admin');
    }

    public function delete22Admin($id)
    {
        $category = Category::find($id)->delete();
        return redirect()->route('category.index22Admin');
    }
}
