<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<style>
  #addInventary {
    view-transition-name: addInventary;

  }
</style>

<div>

  <div class="flex justify-between items-center mb-1">

    <h1 class=" text-left text-5xl text-primario"><?= strtoupper(lang('titles.inventory_2')) ?></h1>

    <a href="<?= base_url('inventary/add') ?>">
      <button id="addInventary" class=" px-28 py-1 border border-terciario-4  rounded-lg hover:bg-terciario-4 hover:text-white transition hover:ease-in ease-out duration-250"><?= lang('titles.n_inventory') ?></button>
    </a>

  </div>

  <div class="flex justify-between items-center mb-1">

    <!-- Search form -->
    <form method='get' action="<?= base_url('inventary'); ?>" id="searchForm" class="flex gap-2 items-center center">
      <input type='text' name='q' value='<?= $search ?>' placeholder="<?= lang('buttons.search') ?>..." class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      <input type='button' id='btnsearch' value='<?= lang('buttons.search') ?>' onclick='document.getElementById("searchForm").submit();' class="bg-primario text-white px-8 py-1 border border-terciario-4 hover:bg-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250">
    </form>

    <!-- <div>

      <a href="<?= base_url('export/xls/' . $search . '') ?>">
        <button id="xls" class=" bg-primario text-white px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4 transition hover:ease-in ease-out duration-250"><?= lang('buttons.export') . " XLS" ?></button>
      </a>
      <a href="<?= base_url('export/csv/' . $search . '') ?>">
        <button id="csv" class=" bg-primario text-white px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4 transition hover:ease-in ease-out duration-250"><?= lang('buttons.export') . " CSV" ?></button>
      </a>
    </div> -->
  </div>

  <?php   // TABLE GENERATED WITH TABLE-GEN-HELPER
  echo $table->generate();
  ?>

  <!-- Paginate -->
  <div>
    <?= $pager->only(['q'])->links() ?>
  </div>

</div>


<?= $this->endSection() ?>