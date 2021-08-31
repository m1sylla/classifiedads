<?php

namespace App\Http\Controllers\Admin;

use App\Category as Category;
use App\CategoryItem as CategoryItem;
use App\CategoryItemAttribute as CategoryItemAttribute;
use App\Attribute as Attribute;

use Illuminate\Support\Arr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('super.admin');
    }


    // categories 
    public function category(){ 
        $categories = Category::All();
        $category_items = CategoryItem::All();
        return view('admin.category.cat_souscat', compact('categories', 'category_items'));
    }

    // add category 
    public function addCategory(Request $request){ 
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::create([
            'name' => $request['name'],
        ]);
        return redirect()->back();
    }

    // delete category 
    public function deleteCategory($id){ 
        Category::where('id',$id)->delete();
        CategoryItem::where('category_id',$id)->delete();
        return redirect()->back();
    }

    // add category item 
    public function addItem(Request $request){ 
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category_item = CategoryItem::create([
            'category_id' => $request['category_id'],
            'name' => $request['name'],
        ]);
        return redirect()->back();
    }

    // delete category item  
    public function deleteItem($id){ 
        CategoryItem::where('id',$id)->delete();
        return redirect()->back();
    }

    // create category item attribute 
    public function attribute(){ 
        $attributes = Attribute::All();
        $subcategories = CategoryItem::All();
        $categories = Category::All();
        return view('admin.category.cat_item_attribute', compact('attributes','subcategories','categories'));
    
    }

    // add category item attribute 
    public function addAttribute(Request $request){ 
        
        $request->validate([
            'name' => 'required|string|max:255',
            'data_type' => 'required',
        ]);
        
        $attribute = Attribute::create([
            'name' => $request['name'],
            'unit' => $request['unit'],
            'unit_exposant' => $request['unit_exposant'],
            'possible_values' => $request['possible_values'],
            'data_type' => $request['data_type'],
        ]);
        return redirect()->back();
    }

    // delete category item attribute
    public function deleteAttribute($id){ 
        //CategoryItem::where('id',$id)->delete();
        //return redirect()->back();
    }

    // link attribute to category 
    public function associateAttribute(Request $request){ 
        $request->validate([
            'subcategory' => 'required',
            'attribute' => 'required',
        ]);
        //dd($request);
        $cat_item_attr = CategoryItemAttribute::create([
            'category_item_id' => $request->subcategory,
            'attribute_id' => $request->attribute,
        ]);
        
        return redirect()->back();
    }

    // send subcat attrs
    public function showSubcatAttribute(Request $request){ 
        $collection = Attribute::whereIn('attributes.id', function ($query) use ($request) {
            $query->select('attribute_id')
                ->from('category_item_attributes')
                ->where('category_item_attributes.category_item_id', $request->subcat_id);
        })->select('name')->get();
        $attributes = $collection->toArray();
        //CategoryItem::where('id',$id)->delete();
        return $attributes;
    }

    // delete attribute from category 
    public function attributeFromCategory($category_id, $attribute_id){ 
        //CategoryItem::where('id',$id)->delete();
        //return redirect()->back();
    }

}
