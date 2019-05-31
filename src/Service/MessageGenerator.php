<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\Response;
class MessageGenerator
{
    private $message;
    public function __construct($message){
        $this->message = $message;
    }
    public function getHappyMessage(Response $response, $jours_restant)
    {
        $content = $response->getContent();
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!', $this->message
        ];
        
        $index = array_rand($messages);
        $content_replace = str_replace('<html>'
             ,'<html>'.'<div style=" background : red;"> jours restants : '.$jours_restant .' </div>', $content);
        $response->setContent($content_replace);
        return $response;
    }
}