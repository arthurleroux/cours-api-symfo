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
     *
     * @param ObjectManager $manager
     *
     * @return Response
     */

    public function getProductsAction(ObjectManager $manager)
    {
        $productRepository  = $manager->getRepository(Product::class);
        $products           = $productRepository->findAll();

        return $this->json($products, Response::HTTP_OK);
    }

}
