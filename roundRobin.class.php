<?php
 

Class roundRobin
{

    /**/
    /** VERIFICAR SE O NUMERO DE ITENS DO ARRAY É IMPAR
    /**/
    private function oddArray($array){
        $countArray = count($array);
        //se for impar adiciona mais um item no array
        if($countArray%2!=0) array_push($array, 'NULL');
        return $array;
    }

    /**/
    /** GIRAR ARRAY NO SENTIDO HORARIO MANTENDO O PRIMEIRO ITEM FIXO
    /**/
    private function rotateArray($array){
       
        $countArray = count($array);
        $endArray = ($countArray-1);
        $rotateArray = array();

        //o primeiro item permanece fixo
        $rotateArray[0] = $array[0];

        //o ultimo item vira o primeiro
        $rotateArray[1] = $array[$endArray];

        //cada item é passo para a proxima chave
        for($i=1; $i<$countArray; $i++) {
            if($i!=$endArray) $rotateArray[$i+1] = $array[$i]; continue;
        }

        return $rotateArray;

    }

    /**/
    /** DIVIDIR O ARRAY EM DUAS PARTES IGUAIS
    /**/
    private function shareArray($array){
        //dividi o array em duas partes
        $shareArray = array_chunk($array, ((int)(count($array)/2)));
        //inverte o segundo item do array
        $shareArray[1] = array_reverse($shareArray[1]);
        return $shareArray;
    }

    /**/
    /** CALCULAR O NÚMERO DE RODADAS
    /**/
    private function calcRounds($array){
         return count($array)-1;   
    }

    /**/
    /** DEFINIR OS CONFRONTOS
    /**/
    private function defineMatch($opponentA, $opponentB, $even = false){
        $match = array();
        if($even==true) {
            $match[0] = $opponentB;
            $match[1] = $opponentA;
        }else{
            $match[0] = $opponentA;
            $match[1] = $opponentB;
        }
        return $match;
    }

    /**/
    /** SORTEAR RODADAS E CONFRONTOS
    /**/
    final function execute($array){

        $arrayRaffle = Self::oddArray($array);
        $roundsCount = Self::calcRounds($arrayRaffle);
        $shareArray = Self::shareArray($arrayRaffle);
        $rounds = array();
        $evenRoundCount = 0;

        for ($i=1; $i<=$roundsCount; $i++) { 
           
            $shareArray = Self::shareArray($arrayRaffle);
            $countShareArray = count($shareArray[0]);
            $eventMatchCount = 0;

            //define o array que vai receber os confrontos
            $rounds[$i] = array();

            //verifica o primeiro confronto de cada rodada se é par ou impar para definer o mando
            if($eventMatchCount%2==0){ $eventMatch = true; }else{ $eventMatch = false; }

            for ($j=0; $j<$countShareArray; $j++) {

                //verifica os demais confrontos de cada rodada se é par ou impar para definer o mando
                if($evenRoundCount%2==0){ $evenRound = true; }else{ $evenRound = false; }

                //verifica qual logica vai usar, se for o primeiro confronto usa a eventMatchCount
                if($j==0){ $evenTest = $evenRound; }else{ $evenTest = $eventMatch; }

                //retorna os oponentes com os mandos definidos
                $match = Self::defineMatch($shareArray[0][$j], $shareArray[1][$j], $evenTest);

                //insere o confronto na array
                array_push($rounds[$i], $match);

                $eventMatchCount++;

            }

            $evenRoundCount++;

            //gira o array no sentido horario mantendo o primeiro item fixo
            $arrayRaffle = Self::rotateArray($arrayRaffle);

        }

        return $rounds;
    }
}