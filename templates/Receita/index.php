<?php
$fun = array(
    0 =>'SIM',
    1 =>'NÃO'
);

?>

<div class="container">
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand"><h3><?= __('Cálculos de Impostos') ?></h3></a>
        <a class="btn btn-outline-info" href="/">Voltar</a>
    </nav>
</div>
<br>

<div class="container">

    <div class="p-3 shadow">
        <div class="form content">
            <?= $this->Form->create() ?>
            <div class="row">
                <div class="col-4 form-group">
                    <?php echo $this->Form->control('salario',['class'=>'form-control','label'=>'SALÁRIO BRUTO', 'id'=>'salario'])?>
                </div>
                <div class="col-4 form-group">
                    <?php echo $this->Form->control('idade',['class'=>'form-control','label'=>'IDADE', 'id'=>'idade'])?>
                </div>
                <div class="col-4 form-group">
                    <?php echo $this->Form->control('funpresp',['options'=>$fun, 'class'=>'form-control','label'=>'FUNPRESP', 'id'=>'funpresp'])?>
                </div>
            </div>
            <div class="row mb-2 mr-1 justify-content-end">
                <?= $this->Form->button(__(' Calcular'), ['class'=>'btn btn-success fas fa-save']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <br>
    <div class="shadow p-2">

        <h4 class="p2 text-center">DADOS DE DESCONTOS</h4>

        <table class="table">
            <tr>
                <th><?= __('PREVIDÊNCIA') ?></th>
                <td class="text-danger"><?php if($resposta != null) echo $this->Number->format($resposta['previdencia'], ['place'=> 2, 'before'=>'R$ ', 'locale'=>'fr_BR']) ?></td>
            </tr>
            <tr>
                <th><?= __('FUNPRESP') ?></th>
                <td class="text-danger"><?php
                    if($resposta != null){
                        if ($resposta['funpresp'] != null)
                             echo $this->Number->format($resposta['funpresp'], ['place'=> 2, 'before'=>'R$ ', 'locale'=>'fr_BR']);
                        else
                            echo "";
                    }else{
                        echo "";
                    }?>
                </td>
            </tr>
            <tr>
                <th><?= __('IMPOSTO DE RENDA') ?></th>
                <td class="text-danger"><?php if($resposta != null) echo $this->Number->format($resposta['iprf'], ['place'=> 2, 'before'=>'R$ ', 'locale'=>'fr_BR']) ?></td>
            </tr>
        </table>
    </div>
    <br>
    <div class="shadow p-2">

        <h4 class="p2 text-center">DADOS DE AUXÍLIOS</h4>

        <table class="table">
            <tr>
                <th><?= __('ALIMENTAÇÃO') ?></th>
                <td class="text-success"><?php if($resposta != null) echo $this->Number->format($resposta['alimentacao'], ['place'=> 2, 'before'=>'R$ ', 'locale'=>'fr_BR']) ?></td>
            </tr>
            <tr>
                <th><?= __('SAÚDE') ?></th>
                <td class="text-success"><?php if($resposta != null) echo $this->Number->format($resposta['saude'], ['place'=> 2, 'before'=>'R$ ', 'locale'=>'fr_BR']) ?></td>
            </tr>
        </table>
    </div>
    <br>
    <div class="shadow p-2">

        <h4 class="p2 text-center">SALÁRIOS</h4>

        <table class="table">
            <tr>
                <th><?= __('SALÁRIO BRUTO') ?></th>
                <td class="text-primary"><?php if($resposta != null) echo $this->Number->format($resposta['bruto'], ['place'=> 2, 'before'=>'R$ ', 'locale'=>'fr_BR']) ?></td>
            </tr>
            <tr>
                <th><?= __('TOTAL DE DESCONTOS') ?></th>
                <td class="text-danger"><?php if($resposta != null) echo $this->Number->format($resposta['descontos'], ['place'=> 2, 'before'=>'R$ ', 'locale'=>'fr_BR']) ?></td>
            </tr>
            <tr>
                <th><?= __('TOTAL DE AUXÍLIOS') ?></th>
                <td class="text-success"><?php if($resposta != null) echo $this->Number->format($resposta['auxilios'], ['place'=> 2, 'before'=>'R$ ', 'locale'=>'fr_BR']) ?></td>
            </tr>
            <tr>
                <th><?= __('SALÁRIO LÍQUIDO') ?></th>
                <td class="text-primary"><?php if($resposta != null) echo $this->Number->format($resposta['liquido'], ['place'=> 2, 'before'=>'R$ ', 'locale'=>'fr_BR']) ?></td>
            </tr>
            <tr>
                <th><?= __('SALÁRIO LÍQUIDO + AUXÍLIOS') ?></th>
                <td class="text-primary"><?php if($resposta != null) echo $this->Number->format($resposta['salariofinal'], ['place'=> 2, 'before'=>'R$ ', 'locale'=>'fr_BR']) ?></td>
            </tr>
        </table>
    </div>
</div>
