<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelPackageRequest;
use App\Models\TravelPackage;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class TestCRUDController extends Controller
{
    private $items = [
        [
            'id' => 1,
            'name' => 'Item 1',
            'description' => 'Description of Item 1',
        ],
        [
            'id' => 2,
            'name' => 'Item 2',
            'description' => 'Description of Item 2',
        ],
        // Tambahkan data dummy lainnya di sini sesuai kebutuhan
    ];

    public function index()
    {
        return view('pages.admin.test-crud.index', ['items' => $this->items]);
    }

    public function create()
    {
        return view('items.create');
    }
 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $newItem = [
            'id' => count($this->items) + 1,
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ];

        array_push($this->items, $newItem);

        return redirect()->route('items.index')->with('success', 'Item added successfully');
    }

    public function edit($id)
    {
        $item = $this->findItemById($id);
        return view('pages.admin.test-crud.index', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $item = $this->findItemById($id);

        if ($item) {
            // Perbarui data item
            $item['name'] = $validatedData['name'];
            $item['description'] = $validatedData['description'];
 
            // Simpan perubahan kembali ke dalam koleksi data dummy Anda ($this->items)
            $this->updateItem($item);
            // return redirect()->route('items')->with('success', 'Item updated successfully');
            // return response()->json(['message', 'Item updated successfully']);
            return view('pages.admin.test-crud.index', ['item' => $item]);
        }

        return redirect()->route('items')->with('error', 'Item not found');
    }
    
    // Metode untuk menyimpan perubahan item kembali ke dalam koleksi
    private function updateItem($updatedItem)
    {
        foreach ($this->items as $key => $item) {
            if ($item['id'] == $updatedItem['id']) {
                // Menggantikan item lama dengan item yang diperbarui
                $this->items[$key] = $updatedItem;
                break;
            }
        }
    }

    public function destroy($id)
    {
        $itemIndex = array_search($id, array_column($this->items, 'id'));
        if ($itemIndex !== false) {
            array_splice($this->items, $itemIndex, 1);
        }

        return redirect()->route('items')->with('success', 'Item deleted successfully');
    }

    private function findItemById($id)
    {
        foreach ($this->items as $item) {
            if ($item['id'] == $id) {
                return $item;
            }
        }

        return null;
    }
}