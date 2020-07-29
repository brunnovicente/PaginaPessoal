<?php

namespace App\Controller;

class ReceitaController extends AppController{

    private $TETO = 6101.06;
    private $ALIMENTACAO = 458;

    public function index(){
        if($this->request->is('post')){
            $data = $this->request->getData();
            $saude = $this->auxilio_saude($data['idade'], $data['salario']);
            if($data['funpresp'] == 0) {
                $funpresp = $this->funpresp($data['salario']);
            }else{
                $funpresp = null;
            }
            $previdencia = $this->previdencia($data['salario']);
            $base = $data['salario'] - ($funpresp + $previdencia);
            $iprf = $this->iprf($base);
            $liquido = $data['salario'] - ($funpresp + $previdencia + $iprf);
            $resposta = [
                'alimentacao' => $this->ALIMENTACAO,
                'saude' => $saude,
                'funpresp' => $funpresp,
                'previdencia' => $previdencia,
                'iprf' => $iprf,
                'base' => $base,
                'bruto' => $data['salario'],
                'descontos' => $previdencia + $funpresp + $iprf,
                'auxilios' => $this->ALIMENTACAO + $saude,
                'liquido' => $liquido,
                'salariofinal' => $liquido + $this->ALIMENTACAO + $saude
            ];
            $this->set('resposta', $resposta);
        }else{
            $resposta = null;
            $this->set('resposta', $resposta);
        }
    }

    public function iprf($base){
        $imposto = 0;
        if($base <= 1903.98){
            $imposto = 0;
        }else if($base <= 2826.65){
            $imposto = ($base * 0.075) - 142.8;
        }else if($base <= 3751.05){
            $imposto = ($base * 0.225) - 354.8;
        }else if($base <= 4664.68){
            $imposto = ($base * 0.225) - 636.13;
        }else{
            $imposto = ($base*0.275) - 869.36;
        }
        return $this->truncate($imposto,2);
    }

    private function funpresp($salario){
        if($salario >= $this->TETO){
            $base = $salario - $this->TETO;
            return $base * 0.085;
        }
        return 0;
    }

    private function calculo_base($salario){
        $prev = $this->previdencia($salario);
        $base = $salario - $prev;
        return $base;
    }

    public function previdencia($salario){

        $valor = array(1045, 1044.6, 1044.8, 2966.66);//, 4346.94, 10448, 19851.2};
        $porcentagem = array(0.075, 0.09, 0.12, 0.14);//, 0.145, 0.165, 0.19};
        $imposto = 0;

        for($i=0;$i<4;$i++){
            if($salario > $valor[$i]){
                $salario = $salario - $valor[$i];
                $imposto += $valor[$i] * $porcentagem[$i];
            }else{
                $imposto += $salario * $porcentagem[$i];
                break;
            }
        }//Fim do for

        //if(salario > 0){
        //    imposto += salario * 0.22;
        //  }
        return $this->truncate($imposto,2);
    }//Fim da Previdência

    private function auxilio_saude($idade, $salario){
        $dados = array(
            array(149.52, 156.57, 158.69, 165.04, 169.97, 175.61, 190.03, 193.05, 196.06, 205.63),
            array(142.47, 149.52, 151.64, 156.57, 161.51, 167.15, 180.76, 183.63, 186.50, 196.06),
            array(135.42, 142.47, 144.59, 149.52, 154.46, 160.10, 171.49, 174.21, 176.94, 186.50),
            array(129.78, 135.42, 137.53, 142.47, 147.41, 153.05, 163.77, 166.37, 168.97, 176.94),
            array(122.71, 129.78, 131.89, 135.42, 140.35, 146.00, 156.04, 158.52, 161.00, 168.97),
            array(111.43, 114.25, 116.38, 117.07, 122.02, 127.66, 129.78, 131.84, 133.90, 137.09),
            array(107.20, 108.61, 110.73, 111.43, 116.38, 122.02, 123.60, 125.56, 127.52, 130.71),
            array(101.56, 102.97, 105.08, 105.79, 110.73, 116.38, 117.42, 119.28, 121.14, 124.33)
        );
        $b = $this->calculo_x($idade);
        $a = $this->calculo_y($salario);

        $auxilio = $dados[$a][$b];
        return $auxilio;
    }

    private function calculo_x($idade){
        if($idade <= 18){
            return 0;
        }else if ($idade > 18 && $idade <= 23){
            return 1;
        }else if($idade >= 24 && $idade <= 28){
            return 2;
        }else if($idade >= 29 && $idade <= 33){
            return 3;
        }else if($idade >= 34 && $idade <= 38){
            return 4;
        }else if($idade >= 39 && $idade <= 43){
            return 5;
        }else if($idade >= 44 && $idade <= 48){
            return 6;
        }else if($idade >= 49 && $idade <= 53){
            return 7;
        }else if($idade >= 54 && $idade <= 58){
            return 8;
        }else{
            return 9;
        }
    }

    private function calculo_y($salario){
        if ($salario <= 1499){
            return 0;
        }else if($salario >= 1500 && $salario <= 1999){
            return 1;
        }else if($salario >= 2000 && $salario <= 2499){
            return 2;
        }else if($salario >= 2500 && $salario <= 2999){
            return 3;
        }else if($salario >= 3000 && $salario <= 3999){
            return 4;
        }else if($salario >= 4000 && $salario <= 5499){
            return 5;
        }else if($salario >= 5500 && $salario <= 7499){
            return 6;
        }else{
            return 7;
        }
    }

    private function truncate($val, $f="0")
    {
        if(($p = strpos($val, '.')) !== false) {
            $val = floatval(substr($val, 0, $p + 1 + $f));
        }
        return $val;
    }

}


?>
