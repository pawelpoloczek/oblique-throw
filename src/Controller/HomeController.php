<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\EntryDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function __invoke(): Response
    {
        return $this->render(
            'home.html.twig',
            [
                'entryDataForm' => $this->createForm(EntryDataType::class)->createView(),
            ]
        );
    }
}
