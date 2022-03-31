## Getting laravel to work  on Linux ubuntu 

`curl -sS https://getcomposer.org/installer | php`

Next, we have to make sure Composer can be used globally and make it executable. The following commands will take care of that.

```
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
```

### Install Laravel on Ubuntu Using Composer
With Composer installed, now we can install Laravel. To do this, run the following command:

`composer create-project --prefer-dist laravel/laravel [project_name]`

replace [project_name] with the name of your application

```
cd example
php artisan serve --host=[IP] --port=[port]
```

To create a crud object:


```
php artisan make:model Product -mcr
```


Find the following file in visual code:
```
database/migrations/2022_03_28_160710_create_products_table.php 
```

Change from
```
 Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->timestamps();
});
```

To:

```
 Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->integer('price');
    $table->text('description');
    $table->timestamps();
});
```


on cli run the following command which will generate the table to DB as per your new definition above

```
php artisan migrate
```



Find  `Model\Product`

Change from:

```
class Product extends Model
{
    use HasFactory;
}
```


to
```
class Product extends Model
{
    use HasFactory;

   protected $table = 'products';
  public $timestamps = true;

  protected $casts = [
      'price' => 'float'
  ];

  protected $fillable = [
      'name',
      'description',
      'price',
      'created_at'
  ];
}
```

Review Controllers\ProductController

```
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
       return view('products.index' ,compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      /*
      $data = $request->validate([
        'name' => 'required',
         'price' => 'required|integer' , 
         'description' => 'required'
      ]);
      */
      
      $request->validate([
        'name' => 'required',
         'price' => 'required|integer' , 
         'description' => 'required'
      ]);

      //Product::create($data);
      Product::create($request->all());
      
      //return redirect()->route('products.index');

      return redirect()->route('products.index')
          ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
      return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
      return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
      $request->validate([
        'name' => 'required',
         'price' => 'required|integer' , 
         'description' => 'required'
      ]);
      $product->name= $request->name;
      $product->price= $request->price;
      $product->description= $request->description;
      $product->save();
      return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return back();
    }
}

```

Review routes/web.php

```
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::resource('products', ProductController::class);
Route::apiResource('/products2', '\App\Http\Controllers\ProductController');

```


Review `views/layouts/app.blade.php` as well as `views/products` there are 4 files `create.blade.php` `edit.blade.php` `show.blade.php` `index.blade.php`




