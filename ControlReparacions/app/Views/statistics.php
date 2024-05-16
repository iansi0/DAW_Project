<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>
<script src="/assets/js/donutchart.js"></script>
<script src="/assets/js/columndatechart.js"></script>
    <header>
        <div class="flex justify-between items-center mb-1">

            <h1 class="text-left text-5xl text-primario"><?= strtoupper(lang('titles.statistics')) ?></h1>
        </div>
    </header>
    
    <div id="comarca"></div>
    
    <div id="type"></div>
    
    <div id="month"></div>
    
    <script>
    
        const count = <?= json_encode($comarca['count']) ?>;
        const name = <?= json_encode($comarca['name']) ?>;
        createDonut(count, name, '#comarca');
    
    </script>     
    
    <script>
        
        const count2 = <?= json_encode($date['count']) ?>;
        const month = <?= json_encode($date['month']) ?>;
        createDateChart(count2, month, 'Total de tickets', 'Tickets per mes' ,'#month');
    
    </script>     
   
   <script>
        
        const count3 = <?= json_encode($type['count']) ?>;
        const type = <?= json_encode($type['type']) ?>;
        createDonut(count3, type, '#type');
    
    </script>     

<?= $this->endSection() ?>