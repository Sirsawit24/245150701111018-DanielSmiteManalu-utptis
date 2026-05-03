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
            "price" => 75000,
            "stock" => 15,
            "category" => "Makanan",
            "origin" => "Karo"
        ],
        [
            "id" => 4,
            "name" => "Arsik Ikan Mas",
            "price" => 60000,
            "stock" => 10,
            "category" => "Makanan",
            "origin" => "Tapanuli"
        ],
        [
            "id" => 5,
            "name" => "Ulos Sibolang",
            "price" => 1200000,
            "stock" => 7,
            "category" => "Kain Tradisional",
            "origin" => "Samosir"
        ],
        [
            "id" => 6,
            "name" => "Dali Ni Horbo",
            "price" => 40000,
            "stock" => 25,
            "category" => "Makanan",
            "origin" => "Toba"
        ],
        [
            "id" => 7,
            "name" => "Gondang Batak (Alat Musik)",
            "price" => 2000000,
            "stock" => 3,
            "category" => "Alat Musik",
            "origin" => "Sumatera Utara"
        ],
        [
            "id" => 8,
            "name" => "Ulos Mangiring",
            "price" => 900000,
            "stock" => 8,
            "category" => "Kain Tradisional",
            "origin" => "Tapanuli"
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
        foreach ($this->products as &$product) {
            if ($product['id'] == $id) {
                $product = array_merge($product, $request->all());

                return response()->json([
                    "status" => "success",
                    "message" => "Produk berhasil diupdate",
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
                $product = array_merge($product, $request->all());

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
