<?php
    if (!$_SESSION['user']) {redirect()->to('/');}
?>
<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-center text-7xl text-primario"><?= strtoupper(lang('titles.config')) ?></h1>

<section class="container mx-auto px-4 py-8 mt-10">
    <form action="addticket" method="POST" class="grid grid-cols-3 gap-x-2">
        <div class="flex flex-col mt-5">
            <label><?=lang('forms.lang')?></label>
            <select name="id_type" id="" class="bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1">
                <option value="cat">Català</option>
                <option value="esp">Español</option>
                <option value="eng">English</option>
            </select>
        </div>        
    </form>
</section>

<div class="flex items-center mt-20 justify-between">
    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"><?=lang('buttons.cancel')?></button>
    <div>
        <button class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded"><?=lang('buttons.add')?></button>
        <button class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded ml-4"><?=lang('buttons.save')?></button>
    </div>
</div>

    
<?= $this->endSection() ?>