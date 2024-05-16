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

    <script>
        var options = {
        chart: {
            type: 'line'
        },
        series: [{
            name: 'sales',
            data: [30,40,35,50,49,60,70,91,125]
        }],
        xaxis: {
            categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
        }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

            chart.render();
    </script>
</main>

<?= $this->endSection() ?>