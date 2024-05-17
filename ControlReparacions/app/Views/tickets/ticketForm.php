<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-5xl text-primario mt-14"><?= lang("titles.n_ticket") ?></h1>

<section style="view-transition-name: addTicket;" class=" mx-auto px-4 py-8 mt-10 text-base">
    <form action="add" method="POST" class="flex flex-col gap-20">

        <div class="grid grid-cols-3 gap-x-2 gap-y-2">
            <!-- descripcio  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.description") ?>*</label>
                <input type="text" name="description" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">

                <?php
                if (validation_errors()) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300 "><?= validation_errors()['description'] ?></p>
                <?php endif ?>
            </div>

            <!-- nom contacte  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.contact_name") ?>*</label>
                <input type="text" name="nameContact" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
                <?php
                if (validation_errors()) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['nameContact'] ?></p>
                <?php endif ?>
            </div>

            <!-- email contacte  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.contact_email") ?>*</label>
                <input type="text" name="emailContact" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
                <?php
                if (validation_errors()) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300 "><?= validation_errors()['emailContact'] ?></p>
                <?php endif ?>
            </div>

            <!-- tipus dispositiu  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.s_disp") ?>*</label>
                <select name="id_type" id="" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                    <option value="" disabled selected hidden><?= lang("forms.s_disp") ?></option>
                    <?php
                    foreach ($types as $type) {
                        echo "<option value='" . $type["id"] . "'>" . $type["nom"] . "</option>";
                    }
                    ?>
                </select>
                <?php
                if (validation_errors()) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300 "><?= validation_errors()['id_type'] ?></p>
                <?php endif ?>
            </div>
            <?php if ((session()->get('user')['role']=="sstt") || (session()->get('user')['role']=="admin") ) : ?>

            <!-- institut emissor  -->
            <div class="flex flex-col  mt-5">

                <button type="button" id="assignSender" class="bg-primario text-white mt-[22px] px-2 py-3  hover:bg-terciario-4 border border-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><?= lang("forms.s_ins") ?></button>

                <label class="hidden" for="sender" id="labelSender"><?= lang("forms.s_ins") ?></label>
                <select name="sender" id="sender" class="border-2 hidden border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">

                    <option value="" disabled selected hidden><?= lang("forms.s_ins") ?></option>
                    <?php
                    foreach ($centers as $center) {
                        echo "<option value='" . $center["codi"] . "'>" . $center["nom"] . "</option>";
                    }
                    ?>

                </select>
            </div>

            <!-- institut reparador  -->
            <div class="flex flex-col  mt-5">

                <button type="button" id="assignRepair" class="bg-primario text-white mt-[22px] px-2 py-3  hover:bg-terciario-4 border border-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><?= lang("forms.s_ins") . " " . lang("forms.work") ?></button>

                <label class="hidden" for="repair" id="labelRepair"><?= lang("forms.s_ins") . " " . lang("forms.work") ?></label>
                <select name="repair" id="repair" class="border-2 hidden border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                    <option value="" disabled selected hidden><?= lang("forms.s_ins") ?></option>
                    <?php
                    foreach ($repairs as $repair) {
                        echo "<option value='" . $repair["codi"] . "'>" . $repair["nom"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <?php endif ?>
        </div>

        <div class="flex gap-5 justify-end w-full">

            <a href="<?= strpos(previous_url(), 'tickets?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/tickets');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <input type="submit" value="<?= lang("buttons.add") ?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>
    </form>
</section>

<script>
    const assignSender = document.getElementById('assignSender');
    const assignRepair = document.getElementById('assignRepair');

    const labelSelect = document.getElementById('labelSender');
    const labelRepair = document.getElementById('labelRepair');

    const contenedorSender = document.getElementById('sender');
    const contenedorRepair = document.getElementById('repair');

    assignSender.addEventListener('click', () => {
        labelSelect.style.display = 'block';
        contenedorSender.style.display = 'block';
        assignSender.style.display = 'none';
    });

    assignRepair.addEventListener('click', () => {
        labelRepair.style.display = 'block';
        contenedorRepair.style.display = 'block';
        assignRepair.style.display = 'none';
    });
</script>

<?= $this->endSection() ?>