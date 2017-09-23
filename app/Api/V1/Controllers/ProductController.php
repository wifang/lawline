<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    use Helpers;

    public function index()
    {
        return $this->currentUser()
            ->products()
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
    }

    public function show($id)
    {
        $product = $this->currentUser()->products()->find($id);

        if(!$product)
            throw new NotFoundHttpException; 

        return $product;
    }

    public function store(Request $request)
    {
        $product = new Product();

        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
		$product->image = $request->get('image');

        if($this->currentUser()->products()->save($product))
            return $this->response->created();
        else
            return $this->response->error('could_not_create_product', 500);
    }

    public function update(Request $request, $id)
    {
        $product = $this->currentUser()->products()->find($id);
        if(!$product)
            throw new NotFoundHttpException;

        $product->fill($request->all());

        if($product->save())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_update_product', 500);
    }

    public function destroy($id)
    {
        $product = $this->currentUser()->products()->find($id);

        if(!$product)
            throw new NotFoundHttpException;

        if($product->delete())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_delete_product', 500);
    }

    private function currentUser() {
        return JWTAuth::parseToken()->authenticate();
    }
}
