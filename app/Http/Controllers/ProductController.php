<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ProductImageRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\models\Product;

class ProductController extends Controller
{

    public function index(request $request)
    {
        $category_name =$request->input('category_name');
        if(!empty($category_name)){
            $products = Product::where('category_name', $category_name)->get();
        }else{
            //ELOQUENT ORM
            $products = Product::all();
            //QueryBuilder作法
            // $products = DB::table('products')->get();
        }
        return view('product.index', [
            "products" => $products,
        ]);
    }

    
    function show($id, Request $request)
    {
        $product = Product::findOrFail($id);
        return view('product.show', ["product" => $product]);
    }
    
    public function create()
    {
        //預設路徑為filesystems.php裡的disk(預設參數設定在local)
        // Storage::delete('public/IMG_0383.JPG');//預設路徑為storage/app
        // Storage::disk('public')->delete('IMG_0379.PNG');
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image'],
            'brand_name' => ['required', 'string'],
            'category_name' => ['required', 'string'],
        ]);
        unset($validatedData["image"]);

        if ($request->has('image')){
            $diskName = "public";
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs(
                'products', 
                $name,
                $diskName
            );
            $validatedData["image_url"] = $path;
        }

        $product = new Product;
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->image_url = $validatedData['image_url'];
        $product->brand_name = $validatedData['brand_name'];
        $product->category_name = $validatedData['category_name'];
        $product->save();
        // Product::create($validatedData);
        return redirect()->route('products.index');
        // //驗證方法一
        // //validator可以控制觸發後的動作
        // $validator = Validator::make($request->all(), [
        //     'product_name' => 'required|string|max:6', //key值為<input>的name(attribute)
        //     'product_price' => 'required|integer|min:0|max:9999',
        //     //    'product_image' => ['required','string',new ProductImageRule],//array寫法
        //     //   'product_image' => ['required','string','regex:/^images\/\w+\.(png|jpe?g)$/i'],//array寫法
        // ], [
        //     'required' => 'The :attribute field is required!!!!', //套用所有的required
        //     'product_name.required' => 'The :attribute field is required????', //指定的required
        // ])->validateWithBag('products');
        // // if ($validator->fails()){
        // //     return redirect('/')->withErrors($validator)->withInput();
        // // }

        // //驗證方法二(不能控制動作)
        // // $validated = $request->validate(
        // //     [
        // //       'product_name' => 'required|string|max:6',//key值為<input>的name
        // //       'product_price' => 'required|integer|min:0|max:9999',
        // //          'product_image' => ['required','string',new ProductImageRule],//array寫法

        // //     //   'product_image' => ['required','string','regex:/^images\/\w+\.(png|jpe?g)$/i'],//array寫法
        // //     ]
        // // );

        // //----------------------------------------------------------------------//
        // //儲存檔案方法一(不能設定檔名)
        // // $path = $request->file('product_image')->store('local');//file參數為要上傳的InputName

        // //儲存檔案方法二(不能設定檔名)
        // // $path = Storage::putFile('products',$request->file('product_image'));

        // //儲存檔案方法三

        // $diskName = "public";

        // $name = $request->file('product_image')->getClientOriginalName(); //取得原檔名
        // //storeAs(指定檔案夾名稱,指定檔名,指定的disk名稱)
        // $path = $request->file('product_image')->storeAs('products', $name, $diskName);

        // // $localPath = public_path("storage/$path");//C:\Users\1234\Desktop\pb_controller\public\storage//使用情境:本地刪除用
        // $url = Storage::disk($diskName)->url($path);        ///storage/IMG_0384.PNG        
        // // // $fullURL = asset($url);//http://127.0.0.1:8000/storage/IMG_0383.JPG
        // // $fullURL = asset(Storage ::disk($diskName)->url($path));//http://localhost:8000/storage/IMG_0381.PNG
        // // // $storage_path = Storage ::disk('public')->path($path);//C:\Users\1234\Desktop\pb_controller\storage\IMG_0379.PNG
        // // $storage_path = storage_path("app/public/$path");
        // // //指令php artisan storage:link 可由storage/public產生軟連結到主目錄/public
        // // return redirect()->route('products.index')->withErrors([
        // //     $localPath,
        // //     $fullURL,
        // //     $url,
        // //     $storage_path
        // // ]);


        // DB::table('products')->insert([
        //     'name' => $request->input('product_name'),
        //     'price' => $request->input('product_price'),
        //     'image_url' => $url
        // ]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return is_null($product) ? abort(404) : view('product.edit', ["product" => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image'],
            'brand_name' => ['required', 'string'],
            'category_name' => ['required', 'string'],
        ]);
        unset($validatedData["image"]);


        if ($request->has('image')){
            $diskName = "public";
            $disk = Storage::disk($diskName);
            // delete file
            if ($disk->exists($product->image_url)){
                $disk->delete($product->image_url);
            }
    
            // save file
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs(
                'products', 
                $name,
                $diskName
            );
    
            // save path
            $validatedData["image_url"] = $path;
        }

        $affected = DB::table('products')
        ->where('id', $id)
        ->update($validatedData);
        return redirect()->route('products.edit', ['product' => $product->id]);
        // $validatorData = Validator::make($request->all(), [
        //     'name' => 'required|string|max:6',
        //     'price' => 'required|integer|min:0|max:9999',
        //     'image_url' => ['nullable', 'image']
        // ], [
        //     'required' => 'The :attribute field is required!!!!',
        //     'name.required' => 'The :attribute field is required????',
        // ])->validateWithBag('products');


        // // $product->update([
        // //     'name' => $request->input('product_name'),
        // //     'price' => $request->input('product_price'),
        // //     'image_url' => $request->input('product_image')
        // // ]);

        // //$validatorData回傳為一個陣列可直接丟進update

        // $product = DB::table('products')->where('id', $id);
        // $product->update($validatorData);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (is_null($product)){
            return redirect()->route('products.index');
        }

        $diskName = "public";
        $disk = Storage::disk($diskName);
        if ($disk->exists($product->image_url)){
            $disk->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
