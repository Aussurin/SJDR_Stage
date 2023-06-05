<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class RecuperateurContexte
{
    public function recupContexte(Request $request){
        $langue = $request->getPreferredLanguage(array('fr'));
        $nomClasse = 'App\Contexte\Contexte'.$langue;

        return new $nomClasse();
    }
}