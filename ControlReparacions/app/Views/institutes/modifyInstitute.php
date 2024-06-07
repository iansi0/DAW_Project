<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>
<h1 class="text-5xl text-primario mt-14"><?= lang("titles.e_ins") ?></h1>

<section class="container mx-auto px-4 py-8 mt-10 text-base">
    <form id="form" action="<?= $institute['codi']; ?>" method="POST" class="flex flex-col gap-20">

        <div class="grid grid-cols-3 gap-x-2">

            <!-- codi  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.code") ?></label>
                <input type="text" name="code" value="<?= $institute['codi'] ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['code'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['code'] ?></p>
                <?php endif ?>
            </div>

            <!-- nom  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.name") ?></label>
                <input type="text" name="name" value="<?= $institute['nom'] ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['name'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['name'] ?></p>
                <?php endif ?>
            </div>

            <!-- actiu -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.active") ?></label>

                <select name="active" id="active" class="border-2  border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                    <option value="<?= $institute['actiu'] ?>" selected hidden><?= $institute['actiu'] == 0 ? 'No' : 'Si' ?></option>

                    <option value='0'>No</option>
                    <option value='1'>Si</option>
                </select>
                <?php
                if (isset(validation_errors()['active'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['active'] ?></p>
                <?php endif ?>
            </div>

            <!-- taller  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.work") ?></label>

                <select name="work" id="work" class="border-2  border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                    <option value="<?= $institute['taller'] ?>" selected hidden><?= $institute['taller'] == 0 ? 'No' : 'Si' ?></option>

                    <option value='0'>No</option>
                    <option value='1'>Si</option>
                </select>
                <?php
                if (isset(validation_errors()['work'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['work'] ?></p>
                <?php endif ?>
            </div>

            <!-- telefon  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.phone") ?></label>
                <input type="text" name="phone" value="<?= $institute['telefon'] ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
                <?php
                if (isset(validation_errors()['phone'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['phone'] ?></p>
                <?php endif ?>
            </div>

            <!-- adreca  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.adress") ?></label>
                <input type="text" name="adress" value="<?= $institute['adreca_fisica'] ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['adress'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['adress'] ?></p>
                <?php endif ?>
            </div>

            <!-- poblacio  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.pobl") ?></label>
                <select name="population" id="" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                    <?php
                    foreach ($populations as $population) {
                        if ($population["id"] == $institute["id_poblacio"]) {
                            echo "<option selected value='" . $population["id"] . "'>" . $population["nom"] . "</option>";
                        } else {
                            echo "<option value='" . $population["id"] . "'>" . $population["nom"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset(validation_errors()['population'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['population'] ?></p>
                <?php endif ?>
            </div>

            <!-- sstt  -->
            <div class="flex flex-col justify-end  mt-5">


                <label class="block" for="sstt" id="labelSender"><?= lang("forms.s_sstt") ?></label>
                <select name="sstt" id="sstt" class="border-2  border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">

                    <!-- <option value="" disabled selected hidden><?= lang("forms.s_sstt") ?></option> -->
                    <?php
                    foreach ($SSTTs as $sstt) {
                        if ($sstt["codi"] == $institute["id_sstt"]) {
                            echo "<option selected value='" . $sstt["codi"] . "'>" . $sstt["nom"] . "</option>";
                        } else {
                            echo "<option value='" . $sstt["codi"] . "'>" . $sstt["nom"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <?php
                if (isset(validation_errors()['population'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['population'] ?></p>
                <?php endif ?>
            </div>

        </div>

        <div class="flex gap-5 justify-end w-full">

            <a href="<?= strpos(previous_url(), 'institutes?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/institutes');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <input type="button" id="submitButton" value="<?= lang("buttons.save") ?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>

    </form>
</section>

<script>
    document.getElementById('submitButton').addEventListener('click', function() {
        Swal.fire({
            title: `<?= lang('alerts.sure') ?>`,
            text: `<?= lang('alerts.sure_sub') ?>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `<?= lang('alerts.yes_upd') ?>`,
            cancelButtonText: `<?= lang('alerts.cancel') ?>`
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: `<?= lang('alerts.updated') ?>`,
                    text: `<?= lang('alerts.updated_sub') ?>`,
                    icon: 'success'
                }).then(() => {

                    document.getElementById('form').submit();
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>