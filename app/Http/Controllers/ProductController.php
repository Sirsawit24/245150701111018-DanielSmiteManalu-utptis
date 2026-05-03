<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $products = [
        [
            "id" => 1,
            "name" => "Ulos Ragidup",
            "price" => 1500000,
            "stock" => 5,
            "category" => "Kain Tradisional",
            "origin" => "Toba"
        ],
        [
            "id" => 2,
            "name" => "Saksang",
            "price" => 50000,
            "stock" => 20,
            "category" => "Makanan",
            "origin" => "Batak Toba"
        ],
        [
            "id" => 3,
            "name" => "Babi Panggang Karo",
            "price" => 70000,
            "stock" => 15,
            "category" => "Makanan",
            "origin" => "Karo"
        ]
    ];
    public function index()
    {
        return response()->json([
            "status" => "success",
            "data" => array_values($this->products)
        ]);
    }
    public function show($id)
    {
        foreach ($this->products as $product) {
            if ($product['id'] == $id) {
                return response()->json([
                    "status" => "success",
                    "data" => $product
                ]);
            }
        }

        return response()->json([
            "status" => "error",
            "message" => "Item dengan ID $id tidak ditemukan"
        ], 404);
    }
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "price" => "required|numeric",
            "stock" => "required|integer",
            "category" => "required|string",
            "origin" => "required|string"
        ]);

        $newProduct = [
            "id" => count($this->products) + 1,
            "name" => $request->name,
            "price" => $request->price,
            "stock" => $request->stock,
            "category" => $request->category,
            "origin" => $request->origin
        ];

        return response()->json([
            "status" => "success",
            "message" => "Produk berhasil ditambahkan",
            "data" => $newProduct
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|string",
            "price" => "required|numeric",
            "stock" => "required|integer",
            "category" => "required|string",
            "origin" => "required|string"
        ]);

        foreach ($this->products as &$product) {
            if ($product['id'] == $id) {
                $product = [
                    "id" => $id,
                    "name" => $request->name,
                    "price" => $request->price,
                    "stock" => $request->stock,
                    "category" => $request->category,
                    "origin" => $request->origin
                ];

                return response()->json([
                    "status" => "success",
                    "message" => "Produk berhasil diperbarui",
                    "data" => $product
                ]);
            }
        }

        return response()->json([
            "status" => "error",
            "message" => "Item dengan ID $id tidak ditemukan"
        ], 404);
    }
    public function patch(Request $request, $id)
    {
        foreach ($this->products as &$product) {
            if ($product['id'] == $id) {

                if ($request->has('name')) {
                    $product['name'] = $request->name;
                }
                if ($request->has('price')) {
                    $product['price'] = $request->price;
                }
                if ($request->has('stock')) {
                    $product['stock'] = $request->stock;
                }
                if ($request->has('category')) {
                    $product['category'] = $request->category;
                }
                if ($request->has('origin')) {
                    $product['origin'] = $request->origin;
                }

                return response()->json([
                    "status" => "success",
                    "message" => "Produk berhasil diupdate sebagian",
                    "data" => $product
                ]);
            }
        }

        return response()->json([
            "status" => "error",
            "message" => "Item dengan ID $id tidak ditemukan"
        ], 404);
    }
    public function destroy($id)
    {
        foreach ($this->products as $key => $product) {
            if ($product['id'] == $id) {
                unset($this->products[$key]);

                return response()->json([
                    "status" => "success",
                    "message" => "Produk berhasil dihapus"
                ]);
            }
        }

        return response()->json([
            "status" => "error",
            "message" => "Item dengan ID $id tidak ditemukan"
        ], 404);
    }
}