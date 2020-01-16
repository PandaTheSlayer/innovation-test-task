<?php

namespace App\Controller;

use App\Entity\Disease;
use App\Entity\Drug;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DiseaseController extends AbstractController
{
    /**
     * @Route("/disease/{id}", name="disease")
     * @param int $id
     * @return JsonResponse
     */
    public function index(int $id)
    {
        /** @var Disease $disease */
        $disease = $this->getDoctrine()
            ->getRepository(Disease::class)
            ->find($id);

        $drugs = $disease->getDrugs()->toArray();

        return $this->json([
            'data' => \array_map(
                fn(Drug $drug) => $drug->getName(),
                $drugs
            )
        ]);
    }
}
