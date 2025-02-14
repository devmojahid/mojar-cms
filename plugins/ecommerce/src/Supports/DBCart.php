<?php

namespace Mojahid\Ecommerce\Supports;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Models\Cart;
use Mojahid\Ecommerce\Models\ProductVariant;
use Illuminate\Support\Facades\Cookie;
use Mojahid\Ecommerce\Repositories\CartRepository;
use Juzaweb\Backend\Models\Post;
use Illuminate\Support\Facades\Log;

class DBCart implements CartContract
{
    protected CartRepository $cartRepository;

    protected Cart $cart;

    protected float $totalPrice = 0;

    public function __construct(
        CartRepository $cartRepository
    ) {
        $this->cartRepository = $cartRepository;
    }

    public function make(string|Cart $cart): static
    {
        global $jw_user;

        if ($cart instanceof Cart) {
            $this->cart = $cart;
        } else {
            $this->cart = $this->cartRepository->firstOrNew(['code' => $cart]);
        }

        if ($jw_user) {
            $this->cart->user_id = $jw_user->id;
        }

        return $this;
    }

    public function add(int $postId, string $type, int $quantity): bool
    {
        return $this->addOrUpdate($postId, $type, $quantity);
    }

    public function update(int $postId, string $type, int $quantity): bool
    {
        return $this->addOrUpdate($postId, $type, $quantity);
    }

    public function addOrUpdate(int $postId, string $type, int $quantity): bool
    {
        try {

            $post = Post::where('id', $postId)
                ->where('type', 'products')
                ->where('status', 'publish')
                ->first();

            if (!$post) {
                Log::error('Post not found:', [
                    'post_id' => $postId,
                    'type' => $type
                ]);
                throw new \Exception('Product not found');
            }

            $items = is_array($this->cart->items) ? $this->cart->items : [];
            $key = "{$type}_{$postId}";

            $price = (float) ($post->getMeta('price') ?? 0);
            $comparePrice = (float) ($post->getMeta('compare_price') ?? 0);
            $skuCode = (string) ($post->getMeta('sku_code') ?? '');
            $barcode = (string) ($post->getMeta('barcode') ?? '');

            $items[$key] = [
                'post_id' => $post->id,
                'type' => $type,
                'quantity' => (int) $quantity,
                'price' => $price,
                'title' => (string) $post->title,
                'thumbnail' => (string) $post->thumbnail,
                'sku_code' => $skuCode,
                'barcode' => $barcode,
                'compare_price' => $comparePrice,
            ];

            $this->cart->items = $items;
            $this->cart->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Error in addOrUpdate:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function bulkUpdate(array $items) : bool
    {
        $newItems = [];
        foreach ($items as $item) {
            $post = Post::where('id', $item['post_id'])
                ->where('type', $item['type'])
                ->first();

            if (!$post) {
                continue;
            }

            $key = "{$item['type']}_{$item['post_id']}";
            $newItems[$key] = [
                'post_id' => $post->id,
                'type' => $post->type,
                'quantity' => $item['quantity'],
                'price' => (float) $post->getMeta('price', 0),
                'title' => $post->title,
                'thumbnail' => $post->thumbnail,
                'sku_code' => $post->getMeta('sku_code'),
                'barcode' => $post->getMeta('barcode'),
                'compare_price' => (float) $post->getMeta('compare_price'),
            ];
        }

        $this->cart->items = $newItems;
        $this->cart->save();
        return true;
    }

    public function removeItem(int $postId, string $type) : bool
    {
        $items = $this->cart->items ?? [];
        $key = "{$type}_{$postId}";
        
        if (isset($items[$key])) {
            unset($items[$key]);
            $this->cart->items = $items;
            $this->cart->save();
        }

        return true;
    }

    public function remove(): bool
    {
        Cookie::queue(Cookie::forget('jw_cart'));
        $this->cart->delete();
        return true;
    }

    public function getItems() : array
    {
        return $this->cart->items ?? [];
    }

    public function isEmpty(): bool
    {
        return empty($this->getItems());
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    public function getCollectionItems(): Collection
    {
        $items = $this->cart->items ?? [];
        
        return collect($items)->map(function($item) {
            $item['line_price'] = $item['price'] * $item['quantity'];
            return $item;
        });
    }

    public function getCode(): string
    {
        return $this->cart->code;
    }

    public function totalPrice(): float
    {
        return $this->getCollectionItems()->sum('line_price');
    }

    public function totalItems(): int
    {
        return count($this->cart->items ?? []);
    }

    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'items' => $this->getItems(),
        ];
    }
}
