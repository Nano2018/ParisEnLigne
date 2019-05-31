<?php
namespace App\Listener;
use App\Service\MessageGenerator;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
class MessageGeneratorListener{
    private $endate;

    private $message;

    public function __construct(MessageGenerator $message, $date){
        $this->message = $message;
        $this->endate = new \DateTime(date($date));
    }

    public function process(FilterResponseEvent $event){
    // On teste si la requête est bien la requête principale (et non une sous-requête)
      if (!$event->isMasterRequest()) {
        return;
      }
      $jours = $this->endate->diff(new \DateTime())->days;
      if($jours > 0){
         return;
      }
      $response = $this->message->getHappyMessage($event->getResponse(), $jours);
      $event->setResponse($response);
    }
}