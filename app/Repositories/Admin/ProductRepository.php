<?php

namespace App\Repositories\Admin;

use App\Models\Product;
use App\Repositories\Admin\Interfaces\ProductRepositoryInterface;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class ProductRepository extends CoreRepository implements ProductRepositoryInterface
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Product::class;
    }

    /**
     * @param int $id
     * @return Product|null
     */
    public function findModel(int $id): ?Product
    {
        return $this->model->find($id);
    }

    /**
     * @return Builder
     */
    public function buildPaginatedQuery(): Builder
    {
        $columns = ['id', 'name', 'image', 'price', 'created_at'];

        return $this->startCondition()
            ->select($columns)
            ->orderBy('created_at', 'DESC');
    }

    /**
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        if (isset($data['image'])) {
            $uploaded = $this->handleImageUpload($data['image']);
            if ($uploaded) {
                $data['image'] = $uploaded;
            }
        }

        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $model = $this->findModel($id);
        if (!$model) {
            return false;
        }

        if (isset($data['image'])) {
            $uploaded = $this->handleImageUpload($data['image']);
            if ($uploaded) {
                $data['image'] = $uploaded;
            }
        }

        return $model->update($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $model = $this->findModel($id);
        if (!$model) {
            return false;
        }

        if ($model->image && Storage::disk('public')->exists($model->image)) {
            Storage::disk('public')->delete($model->image);
        }

        return $model->delete();
    }

    /**
     * @param int $limit
     * @return Collection
     */
    public function dashboard(int $limit = 3): Collection
    {
        $columns = ['id', 'name', 'image', 'price', 'created_at'];

        return $this->startCondition()
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * @param $image
     * @return string|null
     */
    protected function handleImageUpload($image): ?string
    {
        if ($image instanceof UploadedFile) {
            return $image->store('products', 'public');
        }

        return null;
    }
}
