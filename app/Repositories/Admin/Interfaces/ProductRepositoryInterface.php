<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

interface ProductRepositoryInterface
{
    public function findModel(int $id): ?Product;

    public function buildPaginatedQuery(): Builder;

    public function create(array $data): Product;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function dashboard(int $limit = 3): Collection;
}
