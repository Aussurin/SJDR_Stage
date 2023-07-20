<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class MercureController extends AbstractController
{
    #[Route('/s-jdr/chat/{id}', name: 'publish_id')]
    public function publish(HubInterface $hub, Request $request,$id): Response
    {
        $message = $request->headers->get('message');
        $status = $this->getUser()->getPseudo();

        //Definition des commandes disponibles

        if ($message[0] == '/'){
            switch ($message[1]){
                case 'r'://Lancé de dés
                    $i = 3;
                    if (ctype_digit($message[$i])){
                        while (ctype_digit($message[$i+1])){
                            $i++;
                        }
                    }else{
                        $message = 'Commande non reconnu 1';
                        break;
                    }
                    $j = $i+2;
                    /*if (ctype_digit($message[$j])){
                        while (ctype_digit($message[$j+1])){
                            $j++;
                        }
                    }else{
                        $message = 'Commande non reconnu 1';
                        break;
                    }*/
                        $nbdes = intval(substr($message, 3, $i-2 ));
                        $valeurdes = intval(substr($message, $i+2, $j+1));
                        $jets = '';
                        $succes = 0 ;
                        for ($k = 0 ; $k < $nbdes ; $k++){
                            $jet = rand(1, $valeurdes);
                            if ($jet>5){
                                $succes++;
                                if ($jet === 10){
                                    $succes++;
                                }
                            }
                            $jets = $jets.$jet.' ';
                        }
                        $message = $jets;
                        $message = $message.": ".$succes." Succes";
                    break;
                case 'j': //Un joueur a rejoind
                    $status = 'join';
                    $message = substr($message,2,strlen($message));
                    break;
                default :
                    $message = 'Commande non reconnu';
                    break;
            }
        }


        $update = new Update(
            'https://s-jdr/chat/'.$id,
            json_encode([$status => $message])
        );

        $hub->publish($update);

        return new Response('Published !');
    }
}
