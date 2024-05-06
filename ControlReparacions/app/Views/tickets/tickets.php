<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<style>
  #add-ticket {
    view-transition-name: addTicket;

  }
</style>

<div>

  <div class="flex justify-between items-center mb-1">

    <h1 class=" text-left text-5xl text-primario"><?= strtoupper(lang('titles.ticket')) ?></h1>

    <a href="<?= base_url('tickets/add') ?>">
      <button id="add-ticket" class=" px-28 py-1 border border-terciario-4  rounded-lg hover:bg-terciario-4 hover:text-white transition hover:ease-in ease-out duration-250"><?= lang('titles.n_ticket') ?></button>
    </a>

  </div>

  <div class="flex justify-between items-center mb-1">

    <!-- Search form -->
    <form method='get' action="<?= base_url('tickets'); ?>" id="searchForm" class="flex gap-2 items-center center">
      <input type='text' name='q' value='<?= $search ?>' placeholder="<?= lang('buttons.search') ?>..." class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      <input type='button' id='btnsearch' value='<?= lang('buttons.search') ?>' onclick='document.getElementById("searchForm").submit();' class="bg-primario text-white px-8 py-1 border border-terciario-4 hover:bg-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250">
    </form>   

    <!-- Export Buttons -->
    <div>
      <a href="<?= base_url('export/xls/' . $search . '') ?>">
        <button id="xls" class=" bg-primario text-white px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4 transition hover:ease-in ease-out duration-250"><?= lang('buttons.export') . " XLS" ?></button>
      </a>
      <a href="<?= base_url('export/csv/' . $search . '') ?>">
        <button id="csv" class=" bg-primario text-white px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4 transition hover:ease-in ease-out duration-250"><?= lang('buttons.export') . " CSV" ?></button>
      </a>
    </div>
  </div>

  <!-- Filters -->
  <div class="flex justify-between items-center mb-1 mt-2">
    <!-- DISPOSITIUS -->
    <div class="flex-auto">
      <input list="dispositius" name="dispositiu" id="dispositiu" placeholder="Dispositius..." class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      <datalist id="dispositius">
        <option>a</option>
        <option>b</option>
        <option>c</option>
        <option>d</option>
      </datalist>
    </div>
    <!-- CENTRES -->
    <div class="flex-auto">
      <input list="centres" name="centre" id="centre" placeholder="Centres..." class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      <datalist id="centres">
        <option>a</option>
        <option>b</option>
        <option>c</option>
        <option>d</option>
      </datalist>
    </div>
    <!-- DATA -->
    <div class="flex-auto flex flex-col">
      <div class="flex">
        <label for="desde">Desde:</label>
        <input id="desde" type="date" class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>
      <div class="flex">
        <label for="hasta">Hasta:</label>
        <input id="hasta" type="date" class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>
    </div>
    <!-- HORA -->
    <div class="flex-auto flex flex-col">
      <div class="flex">
        <label for="desde">Desde:</label>
        <input id="desde" type="time" class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>
      <div class="flex">
        <label for="hasta">Hasta:</label>
        <input id="hasta" type="time" class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>
    </div>
    <!-- ESTAT -->
    <div class="flex-auto">
      <input list="estats" name="estat" id="estat" placeholder="Estats..." class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      <datalist id="estats">
        <option>a</option>
        <option>b</option>
        <option>c</option>
        <option>d</option>
      </datalist>
    </div>
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