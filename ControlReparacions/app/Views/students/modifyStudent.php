<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<div>
    <div class="flex">

        <h1 class="text-5xl text-primario"><?= strtoupper(lang("titles.e_students")) ?></h1>

    </div>

    <form action="add" method="POST" class="mt-4 flex flex-col gap-2 px-20" enctype="multipart/form-data">
        <!-- BOTONES -->
        <div class="flex justify-end align-middle">

            <a href="<?= strpos(previous_url(), 'students?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/students');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 mr-3 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <input type="submit" id="submitButton" value="<?= lang("buttons.save") ?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">
        
        </div>

        <div class="shadow-xl border-b border-primario rounded-t-xl">

            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-semibold"><?=mb_strtoupper(lang('titles.students_2'))?></h2>
            </div>

            <div class="grid grid-cols-12 mt-2 p-4">

                <div class="col-span-12 grid grid-cols-12">
                    <!-- Nombre  -->
                    <div class="col-span-6 grid-cols-12 text-left px-2">

                        <label class="font-semibold text-primario"><?=mb_strtoupper(lang("forms.name")) ?>*</label>
                        <input value="<?= $student['nom'] ?>" type="text" name="name" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">

                        <?php
                        if (isset(validation_errors()['name'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300 "><?= validation_errors()['name'] ?></p>
                        <?php endif ?>
                    </div>

                    <!-- Apellidos  -->
                    <div class="col-span-6 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?=mb_strtoupper(lang("forms.surnames")) ?>*</label>
                        <input value="<?= $student['cognoms'] ?>" type="text" name="surnames" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150"></input>
                        <?php
                        if (isset(validation_errors()['surnames'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['surnames'] ?></p>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-span-12 grid grid-cols-12 mt-5 mb-3">
                    <!-- Correo  -->
                    <div class="col-span-6 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?=mb_strtoupper(lang("forms.email")) ?>*</label>
                        <input value="<?= $student['correo'] ?>" type="mail" name="email" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150"></input>
                        <?php
                        if (isset(validation_errors()['email'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['email'] ?></p>
                        <?php endif ?>
                    </div>
                    
                    <!-- Curs  -->
                    <div class="col-span-6 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?=mb_strtoupper(lang("forms.course")) ?>*</label>
                        <select value="<?= $student['curs'] ?>" type="text" name="course" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">

                        <option value="" disabled selected hidden><?= lang("forms.s_course") ?></option>
                            <?php foreach ($courses as $course) : ?>
                                <option value="<?= $course["id"] ?>"><?= $course["any"] . " " .  $course['titol'] . " " . $course['clase'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php
                        if (isset(validation_errors()['course'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300 "><?= validation_errors()['course'] ?></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
document.getElementById('submitButton').addEventListener('click', function() {
    
    event.preventDefault();
    
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

<?= $this->endSection() ?>
<?= $this->extend('layouts/master.php') ?>