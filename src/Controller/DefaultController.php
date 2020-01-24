<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    public static $operators = [
        '+' => 'addition',
        '-' => 'subtraction',
        '*' => 'multiplication',
        '/' => 'division',
    ];
    
    public function index(Request $request)
    {
        $templateParams = [];
        
        if ($request->getMethod() == 'POST') {
            
            $input = $request->request->all();
            
            $templateParams['post'] = $input;
            $result = 0;
            
            switch (self::$operators[$input['operator']]) {
                case 'subtraction':
                    $result = (float)$input['value1'] - (float)$input['value2'];
                    break;
                
                case 'multiplication':
                    $result = (float)$input['value1'] * (float)$input['value2'];
                    break;
                
                case 'division':
                    $result = (float)$input['value1'] / (float)$input['value2'];
                    break;
                
                case 'addition':
                default:
                    $result = (float)$input['value1'] + (float)$input['value2'];
                    break;
            }
            
            $result = round($result, 10);
            
            $templateParams['result'] = $result;
        }
        
        return $this->render('base.html.twig', $templateParams);
    }
}