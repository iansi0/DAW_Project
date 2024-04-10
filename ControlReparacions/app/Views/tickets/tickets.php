<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>
<h1 class="text-center text-7xl text-primario"><?= strtoupper(lang('ticket.ticket')) ?></h1>




<div class=" ">

  <div class="flex justify-end gap-5">

     <!-- Search form -->
     <form method='get' action="<?= base_url('/tickets'); ?>" id="searchForm">
      <input type='text' name='q' value='<?= $search ?>' placeholder="Search here..." class="mb-5 px-5 py-1.5  border-2 border-terciario-3">
      <input type='button' id='btnsearch' value='Cercar' onclick='document.getElementById("searchForm").submit();' class="bg-primario text-white  mb-5 px-5 py-2 float-right">
    </form>


    <a href="<?= base_url('export/' . $search . '') ?>">
      <button id="add-ticket" class=" bg-primario text-white px-5 py-2  hover:bg-terciario-4">Export</button>

    </a>

    <a href="<?= base_url('ticketform') ?>">
      <button id="add-ticket" class=" bg-primario text-white px-5 py-2  hover:bg-terciario-4">Add Ticket</button>
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