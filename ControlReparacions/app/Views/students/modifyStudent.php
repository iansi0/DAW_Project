<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-5xl text-primario mt-14"><?= lang("titles.e_students") ?></h1>

<section style="view-transition-name: addTicket;" class=" mx-auto px-4 py-8 mt-10 text-base">
    <form id="form" action="<?= $student['id_user'] ?>" method="POST" class="flex flex-col gap-20">
        <?= csrf_field() ?>

        <div class="grid grid-cols-3 gap-x-2 gap-y-2">

            <!-- Correo  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.email") ?>*</label>
                <input type="mail" name="email" value="<?= $student['correo'] ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
                <?php
                if (isset(validation_errors()['email'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['email'] ?></p>
                <?php endif ?>
            </div>

            <!-- Nombre  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.name") ?>*</label>
                <input type="text" name="name" value="<?= $student['nom'] ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">

                <?php
                if (isset(validation_errors()['name'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300 "><?= validation_errors()['name'] ?></p>
                <?php endif ?>
            </div>

            <!-- Apellidos  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.surnames") ?>*</label>
                <input type="text" name="surnames" value="<?= $student['cognoms'] ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
                <?php
                if (isset(validation_errors()['surnames'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['surnames'] ?></p>
                <?php endif ?>
            </div>

            <!-- Curs  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.course") ?>*</label>
                <select type="text" name="course" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">

                    <?php
                    foreach ($courses as $course) {
                        if ($course["id"] == $student["id_curs"]) {
                            echo "<option selected value='" . $course["id"] . "'>" . $course["any"] . " " .  $course['titol'] . " " . $course['clase'] . "</option>";
                        } else {
                            echo "<option value='" . $course["id"] . "'>" . $course["any"] . " " .  $course['titol'] . " " . $course['clase'] . "</option>";
                        }
                    }
                    ?>

                </select>
                <?php
                if (validation_errors()) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300 "><?= validation_errors()['course'] ?></p>
                <?php endif ?>
            </div>


        </div>


        <div class="flex gap-5 justify-end w-full">

            <a href="<?= strpos(previous_url(), 'students?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/students');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <input type="button"  id="submitButton" value="<?= lang("buttons.add") ?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>
    </form>
</section>

<script>
document.getElementById('submitButton').addEventListener('click', function() {
    Swal.fire({
        title: `<?=lang('alerts.sure')?>`,
        text: `<?=lang('alerts.sure_sub')?>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `<?=lang('alerts.yes_upd')?>`,
        cancelButtonText: `<?=lang('alerts.cancel')?>`
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: `<?=lang('alerts.updated')?>`,
                text: `<?=lang('alerts.updated_sub')?>`,
                icon: 'success'
            }).then(() => {
                
                document.getElementById('form').submit();
            });
        }
    });
});
</script>

<?= $this->endSection() ?><?= $this->extend('layouts/master.php') ?>