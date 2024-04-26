<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<div>

  <div class="flex justify-between items-center mb-1">

    <h1 class=" text-left text-5xl text-primario"><?= strtoupper(lang('titles.ticket')) ?></h1>

    <a href="<?= base_url('ticketform') ?>">
      <button id="add-ticket" class=" px-8 py-1 border border-terciario-4  rounded-lg hover:bg-terciario-4"><?= lang('titles.n_ticket') ?></button>
    </a>

  </div>

  <div class="flex justify-between items-center mb-1">

    <!-- Search form -->
    <form method='get' action="<?= base_url('/tickets'); ?>" id="searchForm" class="flex gap-2 items-center center">
      <input type='text' name='q' value='<?= $search ?>' placeholder="<?= lang('buttons.search') ?>..." class=" px-5 py-1  border-2 rounded-lg border-terciario-3 ">
      <input type='button' id='btnsearch' value='<?= lang('buttons.search') ?>' onclick='document.getElementById("searchForm").submit();' class="bg-primario text-white px-8 py-1 border border-terciario-4 hover:bg-terciario-4 hover:text-secundario rounded-lg">
    </form>


    <a href="<?= base_url('export/' . $search . '') ?>">
      <button id="add-ticket" class=" bg-primario text-white px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4"><?= lang('buttons.export') ?></button>

    </a>
  </div>

  <?php   // TABLE GENERATED WITH TABLE-GEN-HELPER
  echo $table->generate();
  ?>

  <!-- Paginate -->
  <divs>
    <?= $pager->only(['q'])->links() ?>
</div>

</div>



<?= $this->endSection() ?>