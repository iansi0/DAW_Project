<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-5xl text-primario mt-14"><?= lang("titles.n_int") ?></h1>

<section style="view-transition-name: addTicket;" class="container mx-auto px-4 py-8 mt-10 text-base">
    <form action="add" method="POST" class="flex flex-col gap-20">

        <div class="grid grid-cols-3 gap-x-2">

            <!-- descripcion  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.description") ?>*</label>
                <input type="text" name="description" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['description'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['description'] ?></p>
                <?php endif ?>
            </div>

            <!-- id ticket  -->
            <input type="text" name="ticket_id" hidden value="<?= $id_ticket ?>">


            <!-- tipo inventario  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.s_disp") ?></label>
                <select name="id_inventary" id="" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                    <option value="" disabled selected hidden><?= lang("forms.s_disp") ?></option>
                    <?php
                    foreach ($inventary as $product) {
                        echo "<option value='" . $product["id"] . "'>" . $product["nom"] . "</option>";
                    }
                    ?>
                </select>
            </div>

        </div>

        <div class="flex gap-5 justify-end w-full">

            <a href="<?= strpos(previous_url(), 'tickets/') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/tickets/' . $id_ticket);
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <input type="submit" value="<?= lang("buttons.add") ?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>

    </form>
</section>

<?= $this->endSection() ?>