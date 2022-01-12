<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\EntryDataType;
use App\Service\ChartDataCalculator;
use App\Traits\FormErrorsTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ChartDataController extends AbstractController
{
    use FormErrorsTrait;

    private ChartDataCalculator $chartDataCalculator;
    private TranslatorInterface $translator;
    private SerializerInterface $serializer;

    public function __construct(
        ChartDataCalculator $chartDataCalculator,
        TranslatorInterface $translator,
        SerializerInterface $serializer
    ) {
        $this->chartDataCalculator = $chartDataCalculator;
        $this->translator = $translator;
        $this->serializer = $serializer;
    }

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
            $chart = $this->chartDataCalculator->calculateChartData($form->getData());
        } elseif (!$form->isValid()) {
            $errors = $this->getFormErrorMessages($form, $this->translator);
        }

        $responseData = [
            'data' => $chart,
            'errors' => $errors,
        ];

        return new JsonResponse(
            $this->serializer->serialize($responseData, 'json'),
            200,
            [],
            true
        );
    }
}