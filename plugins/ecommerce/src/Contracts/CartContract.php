<?php

namespace Mojahid\Ecommerce\Contracts;

use Illuminate\Support\Collection;
use Mojahid\Ecommerce\Models\Cart;

interface CartContract
{
    public function make(string|Cart $cart): static;
    public function add(int $postId, string $type, int $quantity): bool;
    public function update(int $postId, string $type, int $quantity): bool;
    public function addOrUpdate(int $postId, string $type, int $quantity): bool;
    public function bulkUpdate(array $items): bool;
    public function removeItem(int $postId, string $type): bool;
    public function remove(): bool;
    public function getItems(): array;
    public function isEmpty(): bool;
    public function isNotEmpty(): bool;
    public function totalItems(): int;
    public function totalPrice(): float;
    public function getCollectionItems(): Collection;
    public function getCode(): string;
    public function toArray(): array;
}
