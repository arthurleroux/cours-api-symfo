<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends FOSRestController
{
    /**
     * @FOSRest\Get("/api/products")
     * @param ObjectManager $manager
     * @return Response
     */
    public function getProductsAction(ObjectManager $manager)
    {
        $productRepository  = $manager->getRepository(Product::class);
        $products           = $productRepository->findAll();

        return $this->json($products, Response::HTTP_OK);
    }

    /**
     * @FOSRest\Get("/api/products/{id}")
     * @param ObjectManager $manager
     * @param $id
     * @return Response
     */
    public function getProductAction(ObjectManager $manager, $id)
    {
        $productRepository  = $manager->getRepository(Product::class);
        $product            = $productRepository->find($id);

        if (!$product instanceof Product) {
           $this->json([
               'success' => false,
               'error'   => 'Product not found'
           ], Response::HTTP_NOT_FOUND);
        }

        return $this->json($product, Response::HTTP_OK);
    }

}
