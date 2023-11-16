<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

//    public function __construct(){
//      $this->middleware('auth');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 201);
    }

    public function ProductReviews(Product $product){

        $productWithReviews =  Product::with('Review')->find($product->id);

        if (!$productWithReviews) {
            return response()->json(['error' => 'Product not found'], 404);
        }
//        return response()->json($productWithReviews, 201);

        $sumRating = $product->Review->sum('star');

        return response()->json(['product' => $productWithReviews, 'sumRating' => $sumRating], 201);
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request) // StoreProductRequest Request
    {
        try {
//   ===========   validation here ===========

//            $validated = $request->validate([
//                'name' => 'required',
//                'details' => 'required',
//                'price' => 'required',
//                'stock' => 'required',
//                'discount' => 'required',
//            ]);

            $NewProduct = Product::create($request->all());
            return response()->json($NewProduct, 201);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
//    public function show($id)
//    {
//        $productbyId = Product::where('id' , $id)->first();
//        if (is_null($productbyId)){
//         return response()->json(['error' => 'Sorry, the product was not found.'], 404);
//        }
//        return $productbyId;
//    }

// ========== another way ===========
    public function show(Product $product)
    {
            return response()->json($product, 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $product->update($request->all());
            return response()->json($product, Response::HTTP_ACCEPTED);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(['success' => 'Product has been deleted success'], 200);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
