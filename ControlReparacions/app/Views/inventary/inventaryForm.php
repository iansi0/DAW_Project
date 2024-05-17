<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-5xl text-primario mt-14"><?= lang("titles.n_inventory") ?></h1>

<section style="view-transition-name: addInventary;" class="container mx-auto px-4 py-8 mt-10 text-base">
    <span class="text-danger">
        <?= validation_list_errors(); ?>
    </span>
    <form action="add" method="POST" class="flex flex-col gap-20">

        <div class="grid grid-cols-3 gap-x-2">

            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.name") ?>*</label>
                <input type="text" name="name" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
            </div>

            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.price") ?>*</label>
                <input type="number" name="price" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
            </div>


            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.type_inventary") ?>*</label>
                <select name="type_inventary" id="" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                    <option value="" disabled selected hidden><?= lang("forms.s_inventary") ?></option>
                    <?php
                    foreach ($types as $type) {
                        echo "<option value='" . $type["id"] . "'>" . $type["nom"] . "</option>";
                    }
                    ?>
                </select>
            </div>

        </div>

        <div class="flex gap-5 justify-end w-full">

            <a href="<?= strpos(previous_url(), 'inventary?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/inventary');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <input type="submit" value="<?= lang("buttons.add") ?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>

    </form>
</section>


<?= $this->endSection() ?>