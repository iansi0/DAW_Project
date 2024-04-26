<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl text-primario mt-14"><?= lang('titles.n_ticket') ?></h1>

<section class="container mx-auto px-4 py-8 mt-10 text-base">
    <form action="addticket" method="POST" class="flex flex-col gap-20">

        <div class="grid grid-cols-3 gap-x-2">

            <div class="flex flex-col mt-5">
                <label><?= lang('forms.description') ?> de la avaria</label>
                <input type="text" name="description" class="border-2 border-terciario-1 px-2 py-3 rounded">
            </div>

            <div class="flex flex-col mt-5">
                <label><?= lang('forms.contact_name') ?></label>
                <input type="text" name="nameContact" class="border-2 border-terciario-1 px-2 py-3 rounded"></input>
            </div>

            <div class="flex flex-col mt-5">
                <label><?= lang('forms.contact_email') ?></label>
                <input type="text" name="emailContact" class="border-2 border-terciario-1 px-2 py-3 rounded"></input>
            </div>


            <div class="flex flex-col mt-5">
                <label><?= lang('title.type') ?></label>
                <select name="id_type" id="" class="border-2 border-terciario-1 px-2 py-3 rounded">
                    <option value="1">option 1</option>
                    <option value="2">option 2</option>
                    <option value="3">option 3</option>
                    <option value="4">option 4</option>
                </select>
            </div>

            <div class="flex gap-5">

                <a href="<?= base_url('/tickets') ?>" class="bg-primario hover:bg-red-600 text-white px-4 py-2 rounded">Cancelar</a>

                <input type="submit" value="Añadir" class="bg-green-700 hover:bg-green-500 text-white px-4 py-2 rounded">

            </div>

    </form>
</section>



<?= $this->endSection() ?>