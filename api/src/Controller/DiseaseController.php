<?php

namespace App\Controller;

use App\Entity\Disease;
use App\Entity\Drug;
use App\Repository\DiseaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/disease/{id}", name="disease")
 */
class CureDisease extends AbstractController
{
    /**
     * @param int $id
     * @param DiseaseRepository $diseaseRepository
     * @return JsonResponse
     */
    public function __invoke(int $id, DiseaseRepository $diseaseRepository): JsonResponse
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
