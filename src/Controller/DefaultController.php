<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public static $operators = [
        '+' => 'addition',
        '-' => 'subtraction',
        '*' => 'multiplication',
        '/' => 'division',
    ];
    
    public function index()
    {
        $templateParams = [];
        
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $templateParams['post'] = $_POST;
            $result = 0;
            
            switch (self::$operators[$_POST['operator']]) {
                case 'subtraction':
                    $result = (float)$_POST['value1'] - (float)$_POST['value2'];
                    break;
                
                case 'multiplication':
                    $result = (float)$_POST['value1'] * (float)$_POST['value2'];
                    break;
                
                case 'division':
                    $result = (float)$_POST['value1'] / (float)$_POST['value2'];
                    break;
                
                case 'addition':
                default:
                    $result = (float)$_POST['value1'] + (float)$_POST['value2'];
                    break;
            }
            
            $result = round($result, 10);
            
            $templateParams['result'] = $result;
        }
        
        return $this->render('base.html.twig', $templateParams);
    }
}