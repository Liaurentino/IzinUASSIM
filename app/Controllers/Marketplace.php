<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\MerchantModel;

class Marketplace extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $products = $productModel->findAll(10); // Ambil 10 produk sebagai contoh

        $data = [
            'title' => 'Servify - Marketplace',
            'products' => $products,
        ];
        
        return $this->renderView('pages/marketplace', $data);
    }
    
    public function detail($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('marketplace'));
        }

        $productModel = new ProductModel();
        $merchantModel = new MerchantModel();

        $product = $productModel->find($id);
        
        if (! $product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan: ' . $id);
        }

        // Ambil data merchant
        $merchant = $merchantModel->find($product['merchant_id']);

        $data = [
            'title' => 'Detail Produk',
            'product' => $product,
            'merchant' => $merchant,
        ];
        
        return $this->renderView('pages/product_detail', $data);
    }
}