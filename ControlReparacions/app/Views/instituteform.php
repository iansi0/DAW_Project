<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl text-primario mt-14">><?=strtoupper(lang('titles.ins'))?></h1>

<!-- TODO: CAMBIAR TODAS LAS ID POR DIOS -->
<section class="container mx-auto px-4 py-8 mt-10">
    <form action="" class="grid grid-cols-3 gap-x-2">
        <div class="flex items-center">
            <label for="nombre" class="w-20 text-right mr-2">><?=lang('forms.name')?></label>
            <input type="text" id="name" name="nombre" class="bg-blue-400 rounded px-2 py-3">
        </div>
        <div class="flex items-center">
            <label for="reparador" class="w-20 text-right mr-2 ">REPARADOR</label>
            <!-- TODO: Porque es un tipo texto y no checkbox -->
            <input type="text" id="repairer" name="repairer" class="bg-blue-400 rounded px-2 py-3 border-blue-400 ml-5">
        </div>
        <div class="flex items-center">
            <label for="dni" class="w-16 text-right mr-2">><?=lang('forms.adress')?></label>
            <input type="text" id="adress" name="adress" class="bg-blue-400 rounded px-2 py-3">
        </div>
        <div class="flex items-center mt-12 ml-10">
            <label for="dni" class="w-16 text-right mr-2">Nº*</label>
            <input type="text" id="" name="" class="bg-blue-400 rounded px-2 py-3 border-blue-400">
        </div>
        <div class="flex items-center mt-12 ml-14">
            <label for="apellido" class="w-20 text-right mr-2">CP</label>
            <select id="curso" name="curso" required class="border bg-blue-400 rounded px-2 py-3">
                <option value="">Seleccione uno</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <div class="flex items-center mt-12 ml-24">
            <label for="dni" class="w-16 text-right mr-2">><?=lang('forms.pobl')?></label>
            <select id="Population" name="Population" required class="border bg-blue-400 rounded px-2 py-3 ml-5">
                <option value="">><?=lang('forms.s_pobl')?></option>
                <option value="1">ALVER</option>
                <option value="2">DIAZ</option>
                <option value="3">JULIO</option>
                <option value="4">ROMAN</option>
            </select>
        </div>
    </form>
    <div class="flex items-center mt-20">
        <label for="dni" class="w-auto text-right mr-2">><?=lang('forms.other')?></label>
        <input type="text" id="dni" name="dni" class="bg-blue-400 rounded px-2 py-3 flex-1">
    </div>
</section>

<div class="flex items-center mt-20 justify-between">
    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">><?=lang('buttons.cancel')?></button>
    <div>
        <button class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded">><?=lang('buttons.add')?></button>
        <button class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded ml-4">><?=lang('buttons.save')?></button>
    </div>
</div>



<?= $this->endSection() ?>