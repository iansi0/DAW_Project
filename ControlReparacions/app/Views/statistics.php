<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<main>
    <header>

        <div class="flex justify-between items-center mb-1">

            <h1 class="text-left text-5xl text-primario"><?= strtoupper(lang('titles.statistics')) ?></h1>
        </div>
    </header>
<div id="chart">
</div>

    <script src="donutchart.js"></script>
</main>

<?= $this->endSection() ?>