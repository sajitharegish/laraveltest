<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductModel;

class productController extends Controller
{
    public function create()
    {
         $categories = DB::table('category')
                    ->where('status', 0) // ✅ only active
                    ->select('id', 'category') // ✅ only needed fields
                    ->get();

        return view('create_product', compact('categories'));
    }
    public function getSubcategory($id)
    {
        $subcategories = DB::table('sub_category')
            ->where('category_id', $id)
            ->where('status', 0)
            ->get();
            //  dd($subcategories); // ✅ debug here

        return response()->json($subcategories);
    }

    public function store(Request $request)
    {

    //      dd(
    //     $request->all(),              // all form data
    //     $request->file('image'),      // uploaded file
    //     $request->hasFile('image')    // true/false
    // );
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

            // Upload image
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
        }
        // dd($imageName);

        ProductModel::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'image' => $imageName, // ✅ save image name
            'status' => 0,
            'ip_address' => $request->ip()
        ]);
        return redirect('/product_list')->with('success', 'Product added successfully');


    }

      public function listProductsold()
    {
        $products = DB::table('product')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.subcategory_id')
            ->select(
                'product.*',
                'category.category as category_name',
                'sub_category.subcategory as subcategory_name'
            )
            ->where('product.status', 0)
            ->get();
        
        return view('product_list', compact('products'));
    }




    public function listProducts(Request $request)
    {
        $query = DB::table('product')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.subcategory_id')
            ->select(
                'product.*',
                'category.category as category_name',
                'sub_category.subcategory as subcategory_name'
            );

        // ✅ Filters
        if ($request->filled('category_id')) {
            $query->where('product.category_id', $request->category_id);
        }

        if ($request->filled('subcategory_id')) {
            $query->where('product.subcategory_id', $request->subcategory_id);
        }

        // ✅ Pagination (2 per page)
        $data = $query->paginate(2)->withQueryString();

        // Dropdowns
        $categories = DB::table('category')->where('status', 0)->get();
        $subcategories = DB::table('sub_category')->where('status', 0)->get();

        return view('product_list', compact('data', 'categories', 'subcategories'));
    }



    public function delete($id)
    {
        DB::table('product')->where('id', $id)->update([
            'status' => 1 // ✅ mark as deleted
        ]);

        return redirect('/product_list')->with('success', 'Product deleted successfully');
    }

    public function edit($id)
    {
        // Get product
        $product = DB::table('product')->where('id', $id)->first();

        // Get all categories (active)
        $categories = DB::table('category')
            ->where('status', 0)
            ->get();

        // Get subcategories based on selected category
        $subcategories = DB::table('sub_category')
            ->where('category_id', $product->category_id)
            ->where('status', 0)
            ->get();

        return view('edit_product', compact('product', 'categories', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required'
        ]);

        // $product = ProductModel::findOrFail($id);
        $image = DB::table('product')
            ->where('id', $id)
            ->where('status', 0)
            ->value('image');

        if ($request->hasFile('image')) 
        {

            // delete old
            if ($image && file_exists(public_path('uploads/products/'.$image))) 
            {
                unlink(public_path('uploads/products/'.$image));
            }

            // upload new
            $file = $request->file('image');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $imageName);
        }

        // Update data
        DB::table('product')->where('id', $id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'image' => $imageName,
            'ip_address' => $request->ip()
        ]);

        return redirect('/product_list')->with('success', 'Product updated successfully');
    }

}
