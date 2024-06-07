<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>
<script src="/assets/js/donutchart.js"></script>
<script src="/assets/js/columndatechart.js"></script>
<br>
<header>
    <div class="flex justify-between items-center mb-1">
        <h1 class="text-left text-5xl text-primario"><?= strtoupper(lang('titles.statistics')) ?></h1>
    </div>
</header>
<br>
<main class="grid grid-cols-2 gap-4 justify-center">

    <div class="bg-white rounded-t-lg shadow-xl border-b border-primario">
        <header class="bg-primario rounded-t-xl p-4 mb-2">
            <h2 class="text-2xl font-semibold text-left text-2xl text-secundario"><?=  strtoupper(lang('charts.comarca')) ?></h2>
        </header>
        <div class="flex justify-center">
            <div id="comarca" ></div>
        </div>
    </div>

    <div class="bg-white rounded-t-lg shadow-xl border-b border-primario">
        <header class="bg-primario rounded-t-xl p-4 mb-2">
            <h2 class="text-2xl font-semibold text-left text-2xl text-secundario"><?=  strtoupper(lang('charts.type')) ?></h2>
        </header>
        <div class="flex justify-center">
            <div id="type" ></div>
        </div>
    </div>

    <div class="bg-white rounded-t-lg shadow-xl border-b border-primario">
        <header class="bg-primario rounded-t-xl p-4 mb-2">
            <h2 class="text-2xl font-semibold text-left text-2xl text-secundario"><?= strtoupper(lang('charts.month')); ?></h2>
        </header>
        <div class=" justify-center">
            <div id="month" ></div>
        </div>
    </div>
</main>


<script>
    const count = <?= json_encode($comarca['count']) ?>;
    const name = <?= json_encode($comarca['name']) ?>;
    createDonut("",count, name, '#comarca');
</script>

<script>
    const count2 = <?= json_encode($date['count']) ?>;
    const month = <?= json_encode($date['month']) ?>;
    console.log(count2);
    createDateChart("",count2, month, '', '', '#month');
</script>

<script>
    const count3 = <?= json_encode($type['count']) ?>;
    const type = <?= json_encode($type['type']) ?>;
    createDonut("",count3, type, '#type');
</script>

<?= $this->endSection() ?>