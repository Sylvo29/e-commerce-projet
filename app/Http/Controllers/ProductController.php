<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function load(){
        if(Product::all()->count() < 5){
            $filePath = __DIR__ ."/products.json";
            $fileContent = file_get_contents($filePath);

            $products = json_decode($fileContent, true);


            foreach ($products as $key => $product) {
                $imageUrls = array_map(function($imageUrl){
                    return "images/". $imageUrl;
                }, $product["imageUrls"]);
                $newProduct = new Product();
                $newProduct->name = $product["name"];
                $newProduct->slug = Str::slug($product["name"].' '.$key);
                $newProduct->description = $product["description"];
                $newProduct->moreDescription = $product["more_description"];
                $newProduct->additionalInfos = $product["more_description"];
                $newProduct->stock = rand(200, 600);
                $newProduct->soldePrice = $product["solde_price"];
                $newProduct->regularPrice = $product["regular_price"];
                $newProduct->imageUrls = json_encode($imageUrls);
                $newProduct->isAvailable = $product["isAvailable"];
                $newProduct->isBestSeller = $product["isBestSeller"];
                $newProduct->isNewArrival = $product["isNewArrival"];
                $newProduct->isFeatured = $product["isFeatured"];
                $newProduct->isSpecialOffer = $product["isSpecialOffer"];
                $newProduct->isSpecialOffer = $product["isSpecialOffer"];

                $newProduct->save();
            }

            return [
                'result' => "created"
            ];

        }
        return [
            'result' => "error"
        ];
    }
    public function index(): View
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(5);
        return view('products/index', ['products' => $products]);
    }

    public function show($id): View
    {
        $product = Product::findOrFail($id);

        return view('products/show', ['product' => $product]);
    }
    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('products/create', ['categories' => $categories, "tags"=>$tags]);
    }

    public function edit($id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('products/edit', ['product' => $product, 'categories'=> $categories, "tags"=>$tags]);
    }

    public function store(ProductFormRequest $req): RedirectResponse
    {
        $categories = $req->validated('categories');
        $tags = $req->validated('tags');
        $data = $req->validated();

      

        if ($req->hasFile('imageUrls')) {
            $data['imageUrls'] = json_encode($this->handleImageUpload($req->file('imageUrls')));
        }

        $product = Product::create($data);

        $product->categories()->sync($categories);
        if($tags){
            $product->tags()->sync($tags);
        }


        return redirect()->route('admin.product.show', ['id' => $product->id]);
    }

    public function update(Product $product, ProductFormRequest $req)
    {
        $categories = $req->validated('categories');
        $tags = $req->validated('tags');
        $data = $req->validated();


        if ($req->hasFile('imageUrls')) {
            $uploadedImages = $this->handleImageUpload($req->file('imageUrls'));
            // Suppression des anciennes images s'il en existe
            if ($product->imageUrls && is_array($product->imageUrls)) {
                foreach ($product->imageUrls as $imageUrl) {
                    Storage::disk('public')->delete($imageUrl);
                }
            }
            $data['imageUrls'] = json_encode($uploadedImages);
        }

        $product->update($data);

        $product->categories()->sync($categories);

        if($tags){
            $product->tags()->sync($tags);
        }

        return redirect()->route('admin.product.show', ['id' => $product->id]);
    }

    public function updateSpeed(Product $product, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $product->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Product $product)
    {
        if ($product->imageUrls) {
            foreach ($product->imageUrls as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        $product->delete();

        return [
            'isSuccess' => true
        ];
    }

    private function handleImageUpload(\Illuminate\Http\UploadedFile|array $images): string|array
    {
        if (is_array($images)) {
            $uploadedImages = [];
            foreach ($images as $image) {
                $imageName = uniqid() . '_' . $image->getClientOriginalName();
                $image->storeAs('images', $imageName, 'public');
                $uploadedImages[] = 'images/' . $imageName;
            }
            return $uploadedImages;
        } else {
            $imageName = uniqid() . '_' . $images->getClientOriginalName();
            $images->storeAs('images', $imageName, 'public');
            return 'images/' . $imageName;
        }
    }
}
