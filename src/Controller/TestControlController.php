<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestControlController extends AbstractController
{
    /**
     * @Route("/test/control", name="test_control")
     */
    public function index(): Response
    {
        return $this->render('test_control/index.html.twig', [
            'id' => 7,
        ]);
    }
    /**
     * @Route("/nv-page/{num}", name="nv-page")
     */
    public function nvPage(int $num): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body> Bonjour ' . $num .'. Mon nombre magique est: ' . $number . '</body></html>'
        );
    }

    /**
     * @Route("/nouvel-page/{nom}", name="nouvel-page")
     */
    public function nouvelPage(string $nom): Response
    {
        return new Response(
            '<html><body> Bonjour ' . $nom .' Comment allez vous ? </body></html>'
        );
    }

    /**
     * @Route("/testa/{name}", name="testa")
     */
    public function index2(string $name): Response
    {
        $taille=strlen($name);

        return $this->render('test_control/index.html.twig', [
            'nom' => $name,
            'taille' => $taille,
        ]);
    }
}
