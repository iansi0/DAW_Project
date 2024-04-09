<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>
<h1 class="text-center text-7xl text-primario"><?= strtoupper(lang('ticket.ticket')) ?></h1>




<div class=" ">

  <div class="">

    <button id="add-ticket" class=" bg-primario text-white  mb-5 px-5 py-2 float-right hover:bg-terciario-4">+ Add Ticket</button>


    <!-- Search form -->
    <form method='get' action="<?= base_url('/es/ticket'); ?>" id="searchForm" class="float-right mr-10 p-0">
      <input type='text' name='q' value='<?= $search ?>' placeholder="Search here..." class="mb-5 px-5 py-1.5  border-2 border-terciario-3">
      <input type='button' id='btnsearch' value='Cercar' onclick='document.getElementById("searchForm").submit();' class="bg-primario text-white  mb-5 px-5 py-2 float-right">
    </form>

  </div>



  <?php   // TABLE GENERATED WITH TABLE-GEN-HELPER
  echo $table->generate($tickets);
  ?>




  <!-- Paginate -->
  <divs>
    <?= $pager->only(['q'])->links() ?>
  </div>

</div>



<?= $this->endSection() ?>