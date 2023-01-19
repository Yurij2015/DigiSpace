<?php

namespace App\Services;

use Illuminate\Support\Facades\URL;

class ServicesService
{
    public function addStyleToService($products, $productServices): void
    {
        foreach ($products as $product) {
            foreach ($product->services as $service) {
                foreach ($productServices as $productService) {
                    if ($productService->product_id === $product->id && $productService->service_id === $service->id) {
                        $service->css_style = $productService->service_css_class;
                    }
                }
            }
        }
    }
}
