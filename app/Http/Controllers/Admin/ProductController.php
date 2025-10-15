<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Repositories\Admin\Interfaces\ProductRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|View
    {
        $paginator = $this->repository
            ->buildPaginatedQuery()
            ->paginate(20);

        return view('admin.product.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }

            $model = $this->repository->create($data);
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create product. Please try again' . $e->getMessage());
        }

        return redirect()->route('admin.products.edit', $model->id)
            ->with('success', 'Product created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = $this->repository->findModel($id);
        if (!$model) {
            abort(404);
        }

        return view('admin.product.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, string $id)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }

            $result = $this->repository->update($id, $data);

            if (!$result) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Product not found or update failed.');
            }

            return redirect()->back()
                ->with('success', 'Product updated successfully');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update product. Please try again' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = $this->repository->findModel($id);
        if (!$model) {
            abort(404);
        }

        $this->repository->delete($id);

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
