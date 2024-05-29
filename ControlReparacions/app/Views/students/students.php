<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class=" ">

    <div class="flex justify-between items-center mb-1">

        <h1 class=" text-left text-5xl text-primario"><?= strtoupper(lang('titles.students')) ?></h1>

        <!-- <a href="<?= base_url('work') ?>">
            <button id="add-ticket" class=" px-28 py-1 border border-terciario-4  rounded-lg hover:bg-terciario-4 hover:text-white transition hover:ease-in ease-out duration-250"><?= lang('titles.n_students') ?></button>
        </a> -->

    </div>

    <div class="flex justify-between items-center mb-1">

        <!-- Search form -->
        <form method='get' action="<?= base_url('students'); ?>" id="searchForm" class="flex gap-2 items-center center">
            <input type='text' name='q' value='<?= $search ?>' placeholder="<?= lang('buttons.search') ?>..." class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
            <input type='button' id='btnsearch' value='<?= lang('buttons.search') ?>' onclick='document.getElementById("searchForm").submit();' class="bg-primario text-white px-8 py-1 border border-terciario-4 hover:bg-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250">
        </form>
    </div>

    <?php // TABLA GENERADA CON TABLE-GEN-HELPER
    echo $table->generate();
    ?>

    <!-- Paginación -->
    <div>
        <?= $pager->only(['q'])->links() ?>
    </div>
</div>

<?= $this->endSection() ?>