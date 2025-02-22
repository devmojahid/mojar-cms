<?php

namespace Mojahid\Ecommerce\Http\Controllers\Frontend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Http\Resources\CartResource;
use Mojahid\Ecommerce\Http\Requests\AddToCartRequest;
use Mojahid\Ecommerce\Http\Requests\RemoveItemCartRequest;
use Juzaweb\CMS\Facades\Response;

class FrontendCartController extends FrontendController
{
    protected CartManagerContract $cartManager;

    public function __construct(CartManagerContract $cartManager)
    {
        $this->cartManager = $cartManager;
    }

    /**
     * Add or update an item in cart (via hooking: cart.add-to-cart).
     */
    public function addToCart(AddToCartRequest $request): JsonResponse
    {
        try {
            $postId   = $request->input('post_id');
            $type     = $request->input('type', 'product');
            $quantity = (int) $request->input('quantity', 1);

            $cart = $this->cartManager->find();
            DB::beginTransaction();
            $cart->addOrUpdate($postId, $type, $quantity);
            DB::commit();

            // Return updated cart JSON
            $cookie = Cookie::make('jw_cart', $cart->getCode(), 43200);

            return Response::json([
                'success' => true,
                'message' => trans('ecomm::content.added_to_cart_successfully'),
                'cart' => new CartResource($cart),
            ])->withCookie($cookie);

        } catch (\Exception $e) {
            DB::rollBack();
            return Response::json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove a specific item from the cart (hook: cart.remove-item).
     */
    public function removeItem(RemoveItemCartRequest $request): JsonResponse
    {
        try {
            $postId = $request->input('post_id');
            $type   = $request->input('type', 'product');

            $cart = $this->cartManager->find();

            DB::beginTransaction();
            $cart->removeItem($postId, $type);
            DB::commit();

            $cookie = Cookie::make('jw_cart', $cart->getCode(), 43200);

            return Response::json([
                'success' => true,
                'message' => trans('ecomm::content.item_removed_successfully'),
                'cart' => new CartResource($cart),
            ])->withCookie($cookie);

        } catch (\Exception $e) {
            DB::rollBack();
            return Response::json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update item quantity (hook: cart.update).
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $postId   = $request->input('post_id');
            $type     = $request->input('type', 'product');
            $quantity = (int) $request->input('quantity', 1);

            $cart = $this->cartManager->find();

            DB::beginTransaction();
            $cart->addOrUpdate($postId, $type, $quantity);
            DB::commit();

            $cookie = Cookie::make('jw_cart', $cart->getCode(), 43200);

            return Response::json([
                'success' => true,
                'message' => trans('ecomm::content.cart_updated_successfully'),
                'cart' => new CartResource($cart),
            ])->withCookie($cookie);

        } catch (\Exception $e) {
            DB::rollBack();
            return Response::json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get current cart items (hook: cart.get-items).
     */
    public function getCartItems(): JsonResponse
    {
        $cart = $this->cartManager->find();

        return Response::json([
            'success' => true,
            'cart' => new CartResource($cart),
        ]);
    }
}
