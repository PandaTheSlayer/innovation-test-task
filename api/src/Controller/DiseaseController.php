<?php

namespace App\Controller;

use App\Entity\Disease;
use App\Entity\Drug;
use App\Repository\DiseaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DiseaseController extends AbstractController
{
    /**
     * @Route("/disease/{id}", name="disease")
     * @param int $id
     * @param DiseaseRepository $diseaseRepository
     * @return JsonResponse
     */
    public function index(int $id, DiseaseRepository $diseaseRepository): JsonResponse
    {
        /** @var Disease $disease */
        $disease = $diseaseRepository->find($id);

        $drugs = $disease->getDrugs()->toArray();

        return $this->json([
            'data' => \array_map(
                fn(Drug $drug) => $drug->getName(),
                $drugs
            )
        ]);
    }
}
