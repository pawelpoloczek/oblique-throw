<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\EntryDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ChartDataController extends AbstractController
{
    /**
     * @Route("/calculate-chart-data", name="calculate_chart_data")
     */
    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(EntryDataType::class);
        $form->handleRequest($request);
        $chart = null;
        $errors = null;

        if ($form->isSubmitted() && $form->isValid()) {
            //todo generate chart
        } elseif (!$form->isValid()) {
            $errors = $form->getErrors();
        }

        return new JsonResponse(
            [
                'data' => $chart,
                'errors' => $errors,
            ]
        );
    }
}