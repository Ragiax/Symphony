<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sandbox/route', name: 'sandbox_route')]
class RouteController extends AbstractController
{
    #[Route(
        '/with-variable/{age}',
        name: '_with_variable'
    )]
    public function withVariableAction($age): Response
    {
        return new Response('<body>Route::withVariable : age = ' . $age . '</body>');
    }

    #[Route(
        '/with-default/{age}',
        name: '_with_default',
        defaults: ['age' => 18],
    )]
    public function withDefaultAction($age): Response
    {
        dump($age);
        return new Response('<body>Route::withDefault : age = ' . $age . ' (' . gettype($age) . ')</body>');
    }

    #[Route(
        '/with-constraint/{age}',
        name: '_with_constraint',
        requirements: ['age' => '0|[1-9]\d*'],
        defaults: ['age' => 18],
    )]
    public function withConstraintAction(int $age): Response
    {
        dump($age);
        return new Response('<body>Route::withConstraint : age = ' . $age . ' (' . gettype($age) . ')</body>');
    }

        //////////////// ESSAI //////////////////
    #[Route(
        '/with-four-constraint/{age}/{year}/{month}/{filename}/{ext}',
        name: '_with_4_constraint',
        requirements: ['age' => '0|[1-9]\d*'],
        defaults: ['age' => 18],
    )]
    public function with4ConstraintAction(int $age, $year , $month , $filename , $ext): Response
    {
        dump($age);
        return new Response(
            '<body>Route::with4Constraint : age = ' . $age .'</br>'.
            " Years = ". $year.'</br>'." Month = ". $month.'</br>'." Filename =".$filename.'</br>'." Ext = ".$ext.'</br>'." " . ' (' . gettype($age) .  ')</body>');
    }
    ////////// Fin ESSAI ///////////////
    #[Route(
        '/test1/{year}/{month}/{filename}.{ext}',
        name: '_test1',
    )]
    public function test1Action($year, $month, $filename, $ext): Response
    { // 4 paramètre
        $args = array(
            'title' => 'test1',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );
        return $this->render('Sandbox/Route/test1234.html.twig', $args);
    }

    #[Route(
        '/test2/{year}/{month}/{filename}.{ext}',
        name: '_test2',
        requirements: [
            'year' => '[1-9]\d{0,3}',
            'month' => '(0?[1-9])|(1[0-2])',
            'filename' => '[-a-zA-Z]+',
            'ext' => 'jpg|jpeg|png|ppm',
        ],
    )]
    public function test2Action(int $year, int $month, string $filename, string $ext): Response
    { // Mis en place des Requierement
        $args = array(
            'title' => 'test2',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );
        return $this->render('Sandbox/Route/test1234.html.twig', $args);
    }

    #[Route(
        '/test3/{year}/{month}/{filename}.{ext}',
        name: '_test3',
        requirements: [
            'year' => '[1-9]\d{0,3}',
            'month' => '(0?[1-9])|(1[0-2])',
            'filename' => '[-a-zA-Z]+',
            'ext' => 'jpg|jpeg|png|ppm',
        ],
        defaults: [
            'ext' => 'png',    // on peut proposer une valeur non valide comme "gif"
        ],
    )]
    public function test3Action(int $year, int $month, string $filename, string $ext): Response
    { // Mise en place des valeurs Default
        $args = array(
            'title' => 'test3',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );
        return $this->render('Sandbox/Route/test1234.html.twig', $args);
    }




}

