<?php
    if (!session('user')) {redirect()->to('/');}
?>
<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-center text-7xl text-primario"><?= strtoupper(lang('titles.config')) ?></h1>

<section class="container mx-auto px-4 py-8 mt-10">

    <form action="config" method="POST">

        <div class="w-full grid grid-cols-2 gap-x-3">
            <!-- ID -->
            <!-- <div class="flex flex-col mt-5">
                <label for="input_id"><?=lang('forms.id')?></label>
                <input id="input_id" name="input_id" type="text" class="border-2 border-terciario-1 px-2 py-3 rounded" readonly disabled value="<?=$user['id']?>">
            </div> -->

            <!-- CODIGO -->
            <!-- <div class="flex flex-col mt-5">
                <label for="input_code"><?=lang('forms.code')?></label>
                <input id="input_code" name="input_code" type="text" class="border-2 border-terciario-1 px-2 py-3 rounded" value="<?=$user['code']?>">
            </div> -->

            <!-- NOMBRE -->
            <!-- <div class="flex flex-col mt-5">
                <label for="input_name"><?=lang('forms.name')?></label>
                <input id="input_name" name="input_name" type="text" class="border-2 border-terciario-1 px-2 py-3 rounded" value="<?=$user['name']?>">
            </div> -->
            
            <!-- DIRECCION -->
            <!-- <div class="flex flex-col mt-5">
                <label for="input_adress"><?=lang('forms.adress')?></label>
                <input id="input_adress" name="input_adress" type="text" class="border-2 border-terciario-1 px-2 py-3 rounded" value="<?=$user['adress']?>">
            </div> -->

            <!-- TELEFONO -->
            <!-- <div class="flex flex-col mt-5">
                <label for="input_phone"><?=lang('forms.phone')?></label>
                <input id="input_phone" name="input_phone" type="text" class="border-2 border-terciario-1 px-2 py-3 rounded" value="<?=$user['phone']?>">
            </div> -->

            <!-- OTROS -->
            <!-- <div class="flex flex-col mt-5">
                <label for="input_other"><?=lang('forms.other')?></label>
                <input id="input_other" name="input_other" type="text" class="border-2 border-terciario-1 px-2 py-3 rounded" value="<?=$user['other']?>">
            </div> -->
            
            <!-- IDIOMA -->
            <div class="flex flex-col mt-5">
                <label for="select_lang"><?=lang('forms.lang')?></label>
                <select name="select_lang" id="select_lang" class="border-2 border-terciario-1 px-2 py-3 rounded ">
                    <option <?=(session('user')['lang']=='ca')?'selected':''?> value="ca">Català</option>
                    <option <?=(session('user')['lang']=='es')?'selected':''?> value="es">Español</option>
                    <!-- <option <?=(session('user')['lang']=='en')?'selected':''?> value="en">English</option> -->
                </select>
            </div>
        </div>

        <div class="flex items-center mt-20 justify-end">
            <div>
                <a href="<?=base_url('/')?>"><button class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?=lang('buttons.cancel')?></button></a>
                <input type="submit" class="bg-green-700 hover:bg-green-500 text-white px-4 py-2 rounded ml-4 transition hover:ease-in ease-out duration-250" style="cursor: pointer;" value="<?=lang('buttons.save')?>">
            </div>
        </div>
    </form>

</section>
   
<?= $this->endSection() ?>