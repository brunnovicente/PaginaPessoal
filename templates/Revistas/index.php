<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Revista[]|\Cake\Collection\CollectionInterface $revistas
 */
$this->Paginator->setTemplates([
    'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="{{url}}">{{text}}</a></li>',
]);

$UF = array(
    '' => '',
    'A1'=>'A1',
    'A2'=>'A2',
    'A3'=>'A3',
    'A4'=>'A4',
    'B1'=>'B1',
    'B2'=>'B2',
    'B3'=>'B3',
    'B4'=>'B4',
    'C'=>'C',
    'NP'=>'NP',
);

?>

<div class="container">

    <div class="container-fluid bg-light text-center">
        <h2>Lista de Periódicos - Qualis Novo (2020)</h2>
        <h4>Bruno Vicente Alves de Lima</h4>
    </div>

    <div class="container-fluid">
        <?= $this->Form->create(null, ['type'=>'get'])?>
        <div class="row">
            <div class="col-12">
                <?php echo $this->Form->control('busca',['class'=>'form-control', 'placeholder'=>'Digite o nome ou o ISSN', 'label'=>'Nome ou ISSN','id'=>'busca']);?>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <?php echo $this->Form->control('buscaQ',['options'=>$UF,'class'=>'form-control', 'placeholder'=>'Qualis', 'label'=>'Qualis','id'=>'buscaQ']);?>
            </div>
            <div class="col-6">

            </div>
            <div class="col-2">
                <div class="row pt-4 mb-2 mr-1 justify-content-end">
                    <?= $this->Form->button(__(' Buscar'), ['class'=>'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <br>
    <div>
        <b>Observações:</b> A lista não se refere ao qualis novo definitivo e sim à uma prévia que disponibilizada.
    </div>
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th><?= $this->Paginator->sort('issn', 'ISSN') ?></th>
                <th><?= $this->Paginator->sort('titulo', 'TÍTULO') ?></th>
                <th><?= $this->Paginator->sort('estrato', 'EXTRATO') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($revistas as $revista): ?>
            <tr>
                <td><?= h($revista->issn) ?></td>
                <td><?= h($revista->titulo) ?></td>
                <td><?= h($revista->estrato) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    echo $this->Paginator->counter(
        'Página {{page}} de {{pages}}, mostrando {{current}} periódicos de
     {{count}}.'
    )
    ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->prev('< ' . ('Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(('Próxima') . ' >') ?>
        </ul>
    </nav>
</div>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-173008523-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-173008523-1');
</script>
