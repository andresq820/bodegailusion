<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Product;
use DB;


class ProductsController extends Controller
{
    public function getDashboard()
    {
        if (Auth::check()){
        
            $products = Product::orderBy('created_at', 'desc')->paginate(25);
        
            return view('dashboard.admin_index', compact('products'));            
        }
        
            $products = Product::orderBy('created_at', 'desc')->paginate(25);
        
            return view('dashboard.index', compact('products'));
        

    }
    
    
    public function getList(Request $request)
    {
        if (!Auth::check()){
            $search = $request->input('search');
            
            $products = Product::latest()->search($search)->paginate(12);      

            return view('products.list', compact('products', 'search'));     
        }
        
        $search = $request->input('search');
        
        $products = Product::latest()->search($search)->paginate(12);      
            
        return view('products.admin_list', compact('products', 'search'));
    }
    
    
    public function getCreate()
    {
        if (Auth::check()){
            return view('products.create');
        }
        
        return redirect()->route('getLogin');
        
    }
    
    
    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|max: 5|alpha_num|unique:products',
            'description' => 'required|max: 20|unique:products',
            'amount' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png,gif,bmp'
        ]);
        

        
        $product = new Product();
        $product->code = strtoupper($request['code']);
        $product->description = ucfirst($request['description']);
        $product->in = $request['amount'];
        $product->out = 0;
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $extension = Input::file('image')->getClientOriginalExtension();
            $fileName = preg_replace('/\s+/', '', $product->description.'.'.$extension);
            Storage::disk('local')->put($fileName, File::get($image));    
            $product->image = $fileName; 
        }
        
        $product->save();
        
        return redirect()->route('dashboard')->with(['success' => 'New product added successfully']);
        
        
    }
    
    
    public function getEdit($product_id)
    {
        if (Auth::check()){
            
            $product = Product::find($product_id);
            
            if(!$product_id){
                return redirect()->route('dashboard')->with(['fail' => 'Product not found!']);
            }
            
            return view('products.edit', ['product' => $product]);
        }
        
        return redirect()->route('getLogin');

    }
    
    
    public function postEdit(Request $request)
    {
       if (Auth::check()){
        
        if(empty($request['amount'])){
            $this->validate($request, [
                'code' => 'required|max: 5|alpha_num',
                'description' => 'required|max: 20',
            ]);
        }else{
            $this->validate($request, [
                'code' => 'required|max: 5|alpha_num',
                'description' => 'required|max: 20',
                'amount' => 'numeric',
                'type' => 'required'
                
            ]);
        }

        
        $product = Product::find($request['product_id']);
        $product->code = strtoupper($request['code']);
        $product->description = ucfirst($request['description']);
        if($request['type'] == 'in'){
            $product->in += $request['amount'];    
        }elseif($request['type'] == 'out'){
            $product->out += $request['amount'];     
        }
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $extension = Input::file('image')->getClientOriginalExtension();
            $fileName = preg_replace('/\s+/', '', $product->description.'.'.$extension);
            Storage::disk('local')->put($fileName, File::get($image));    
            $product->image = $fileName; 
        }else{
            $file = explode(".", $product->image);
            $extension = end($file);
            $fileName = preg_replace('/\s+/', '', $product->description.'.'.$extension);
            Storage::disk('local')->move($product->image, $fileName);
            $product->image = $fileName;
             
        }
        
        $product->update();
        
        return redirect()->route('dashboard')->with(['success' => 'Product successfully updated']);
       }
        
        return redirect()->route('getLogin')->with(['fail' => 'You must be logged in to edit a product.']);
    
    }
    
    public function delete($product_id)
    {
        
        if (Auth::check()){
            
            $product = Product::find($product_id);
            Storage::delete($product->image);
            $product->delete();
        
            return redirect()->back()->with(['success' => 'Product deleted succefully.']);
        }
        
        return redirect()->route('getLogin')->with(['fail' => 'You must be logged in to delete a product.']);
        
    }
    
    public function getImage($image)
    {
        $file = Storage::disk('local')->get($image);
        
        return new Response($file, 200);
    }
    
/*    public function tableSearch(Request $request){
        
        if ($request->ajax())
        {
            $output = "";
            $products = DB::table('products')
                ->where('code', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')->get();
            
            if ($products)
            {
                foreach($products as $key => $product){
                    $output .=  '<tr class="gradeA odd" role="row">' .  
                                    '<td class="text-center" data-id="{{ $product->id }}">'. $product->id .'</td>'.                          
                                    '<td class="text-center">' . $product->code . '</td>'.
                                    '<td class="displayImage" >' . '<img class="table_image" src="{{  route("product.image", ["image" => $product->image])  }}" alt="{{ $product->image }}">' . '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $product->description . '</td>'.
                                    '<td class="text-center">' . $product->in . '</td>'.
                                    '<td class="text-center">' . $product->out . '</td>'.
                                    '<td class="text-center">' . $product->in . '</td>'.
                                '</tr>';   
                }

            }
            
            return Response($output);
        }
    }*/
}