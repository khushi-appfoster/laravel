<?php

namespace App\Http\Controllers;
use App\Models\Product; // Import the Product model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //This method will show product page
    public function index(){
        $products = Product::orderBy('created_at','DESC')->get();
          return view ('products.list',[
            'products'=> $products
          ]);
    }
    //This method will create product page.
    public function create(){
          return view('products.create');
    }
    //  This method will store a product in db.
    public function store(Request $request){
    $rules =[
        'uname'=> 'required|min:3',
        'pname' => 'required|min:4',
        'pid' => 'required|numeric'
    ];

    if($request->image != ""){
        $rules['image']='image';
    }
     $validator =  Validator:: make($request->all(),$rules);
     if($validator->fails()){
     return redirect()->route('products.create')->withInput()->withErrors($validator);
    }
    //here we will insert product in database
    $product = new Product();
    $product->uname = $request->uname;
    $product->pname = $request->pname;
    $product->pid = $request->pid;
    $product->description = $request->description;
    $product->save();

    if($request->image != ""){
        $rules['image']='image';
       //here we will insert image
    $image = $request->image;
    $ext = $image->getClientOriginalExtension();
    $imageName = time().'.'.$ext; //unique image name

    //save image to products directory
    $image->move(public_path('uploads/products'),$imageName);

    //save image in db
    $product->image = $imageName;
    $product->save();

    }

    

    return redirect()->route('products.index')->with('sucess','Product added successfully.');
}
    //This method will edit product.
    public function edit($id){
        $product = Product::findOrfail($id);
        return view('products.edit',[
            'product'=>$product
        ]);
    }
    //This method will update product
    public function update($id, Request $request){
        $product = Product::findOrfail($id);
        $rules =[
            'uname'=> 'required|min:3',
            'pname' => 'required|min:4',
            'pid' => 'required|numeric'
        ];
    
        if($request->image != ""){
            $rules['image']='image';
        }
         $validator =  Validator:: make($request->all(),$rules);
         if($validator->fails()){
         return redirect()->route('products.edit',$product->id)->withInput()->withErrors($validator);
        }
        //here we will update product in database
       
        $product->uname = $request->uname;
        $product->pname = $request->pname;
        $product->pid = $request->pid;
        $product->description = $request->description;
        $product->save();
    
        if($request->image != ""){

            File::delete(public_path('uploads/products/'.$product->image));
            $rules['image']='image';
           //here we will insert image
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext; //unique image name
    
        //save image to products directory
        $image->move(public_path('uploads/products'),$imageName);
    
        //save image in db
        $product->image = $imageName;
        $product->save();
    
        }
    
        
    
        return redirect()->route('products.index')->with('sucess','Product updated successfully.');
    }
    //This method will delete product
    public function destroy($id){
        $product = Product::findOrfail($id);

        //delete image
        File::delete(public_path('uploads/products/'.$product->image));

        //delete product from db.
        $product->delete();

        return redirect()->route('products.index')->with('sucess','Product deleted successfully.');
    }
    }


