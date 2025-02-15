<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Http\Controllers\Frontend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Http\Requests\AddToCartRequest;
use Mojahid\Ecommerce\Http\Requests\BulkUpdateCartRequest;
use Mojahid\Ecommerce\Http\Requests\RemoveItemCartRequest;
use Mojahid\Ecommerce\Http\Resources\CartResource;
use Juzaweb\CMS\Abstracts\Action;

class CartController extends FrontendController
{
    protected CartManagerContract $cartManager;
    protected bool $themeView = false;
    protected const VIEW_PATH = 'ecomm::frontend.cart.index';
    protected const THEME_VIEW_PATH = 'theme::frontend.cart.index';

    public function __construct(CartManagerContract $cartManager)
    {
        $this->cartManager = $cartManager;
    }

    public function index(): View
    {
        $this->initializeThemeView();
        $cart = $this->cartManager->find();

        return view($this->getViewPath(), $this->getViewData($cart));
    }

    protected function initializeThemeView(): void
    {
        if ($this->isCartRoute() && $this->themeViewExists()) {
            $this->themeView = true;
            $this->initializeThemeActions();
        }
    }

    protected function isCartRoute(): bool
    {
        return request()->route()->getName() === 'ecomm.cart';
    }

    protected function themeViewExists(): bool
    {
        return view()->exists(self::THEME_VIEW_PATH);
    }

    protected function initializeThemeActions(): void
    {
        do_action('ecomm.cart.index');
        do_action(Action::WIDGETS_INIT);
        do_action(Action::BLOCKS_INIT);
    }

    protected function getViewPath(): string
    {
        return $this->themeView ? self::THEME_VIEW_PATH : self::VIEW_PATH;
    }

    protected function getViewData(CartContract $cart): array
    {
        return [
            'title' => trans('ecomm::content.shopping_cart'),
            'cart' => $cart,
            'items' => new CartResource($cart),
            'total_items' => $cart->totalItems(),
            'total_price' => ecom_price_with_unit($cart->totalPrice())
        ];
    }

    public function addToCart(AddToCartRequest $request): HttpResponse|JsonResponse|RedirectResponse
    {
        $postId = $request->input('post_id');
        $type = $request->input('type', 'product');
        $quantity = $request->input('quantity');

        $cart = $this->cartManager->find();

        DB::beginTransaction();
        try {
            $cart->addOrUpdate($postId, $type, $quantity);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return $this->error([
                'message' => $e->getMessage(),
            ]);
        }

        return $this->responseCartWithCookie(
            $cart,
            trans('ecomm::content.added_to_cart_successfully')
        );
    }

    public function removeItem(RemoveItemCartRequest $request): JsonResponse|RedirectResponse
    {
        $postId = $request->input('post_id');
        $type = $request->input('type', 'product');

        $cart = $this->cartManager->find();

        DB::beginTransaction();
        try {
            $cart->removeItem($postId, $type);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return $this->error([
                'message' => $e->getMessage(),
            ]);
        }

        return $this->responseCartWithCookie(
            $cart,
            trans('ecomm::content.item_removed_successfully')
        );
    }

    public function bulkUpdate(
        BulkUpdateCartRequest $request
    ): HttpResponse|JsonResponse|RedirectResponse {
        $items = (array) $request->input('items');
        $cart = $this->cartManager->find();

        DB::beginTransaction();
        try {
            $cart->bulkUpdate($items);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return $this->error([
                'message' => $e->getMessage(),
            ]);
        }

        return $this->responseCartWithCookie(
            $cart,
            trans('ecomm::content.cart_updated_successfully')
        );
    }

    public function remove(): JsonResponse|RedirectResponse
    {
        $cart = $this->cartManager->find();

        DB::beginTransaction();
        try {
            $cart->remove();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return $this->error([
                'message' => $e->getMessage(),
            ]);
        }

        return $this->success([
            'message' => trans('ecomm::content.cart_cleared_successfully'),
            'cart' => new CartResource($cart),
        ]);
    }

    public function getCartItems(): JsonResponse
    {
        $cart = $this->cartManager->find();

        return response()->json([
            'code' => $cart->getCode(),
            'total_items' => $cart->totalItems(),
            'total_price' => ecom_price_with_unit($cart->totalPrice()),
            'items' => new CartResource($cart)
        ]);
    }

    protected function responseCartWithCookie(CartContract $cart, string $message): JsonResponse|RedirectResponse
    {
        $cookie = Cookie::make('jw_cart', $cart->getCode(), 43200);

        return $this->success([
            'cart' => new CartResource($cart),
            'message' => $message,
        ])->withCookie($cookie);
    }

    protected function formatCartItem($post, $quantity = 1): array
    {
        return [
            'post_id' => $post->id,
            'title' => $post->title,
            'thumbnail' => $post->thumbnail,
            'price' => (float) ($post->getMeta('price') ?? 0),
            'compare_price' => (float) ($post->getMeta('compare_price') ?? 0),
            'quantity' => (int) $quantity,
            'sku_code' => (string) ($post->getMeta('sku_code') ?? ''),
            'barcode' => (string) ($post->getMeta('barcode') ?? ''),
            'type' => 'product'
        ];
    }
}
