<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<main class=" h-full">

    <div class="flex justify-between items-center mb-1">

        <h1 class="text-left text-5xl text-primario"><?= mb_strtoupper(lang('titles.config')) ?></h1>

    </div>

    <aside>
        
        <!-- info alumno  -->
        <div class="shadow-xl border-b grid grid-cols-12 border-primario rounded-t-xl">

            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-semibold"><?=mb_strtoupper(lang('forms.info')).' '.mb_strtoupper(lang('titles.students_2'))?></h2>
            </div>

            <div class="col-span-12 grid grid-cols-12">

                <div class="grid col-span-12 grid-cols-12 mt-2 p-4">
                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.name'))?>: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $student['nom'] ?> </p>
                        </div>
                    </div>

                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.surnames'))?>: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $student['cognoms'] ?> </p>
                        </div>
                    </div>
                </div>

                <div class="grid col-span-12 grid-cols-12 mt-2 p-4">
                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.email'))?>: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $student['correo'] ?> </p>
                        </div>
                    </div>

                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.course'))?>: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $student['curs'] ?> </p>
                        </div>
                    </div>

                    <div class="col-span-12 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <form id="form" action="<?= base_url('config/passwd') ?>" method="POST" class="mt-4 flex flex-col gap-2 px-20">
                                <label class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.e_passwd'))?>*</label>
                                <input type="password" name="passwd" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                                <?php
                                if (isset(validation_errors()['passwd'])) : ?>
                                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['passwd'] ?></p>
                                <?php endif ?>
                                <input type="submit" id="submitButton" value="Actualitzar" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- info insti  -->
        <div class="shadow-xl border-b grid grid-cols-12 border-primario rounded-t-xl mt-6">

            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-semibold"><?=mb_strtoupper(lang('forms.info')).' '.mb_strtoupper(lang('titles.ins_2'))?></h2>
            </div>

            <div class="col-span-12 grid grid-cols-12 mb-6 p-4">

                <div class="col-span-6 grid grid-cols-12 mt-3">
                    <div class="col-span-12 grid-cols-12 text-left px-2">
                        <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.name'))?>: </p>
                        <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['nom'] ?> </p>
                    </div>
                </div>

                <div class="col-span-3 grid grid-cols-12 mt-3">
                    <div class="col-span-12 grid-cols-12 text-left px-2">
                        <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.code') . ' ' . lang('titles.ins_2') )?>: </p>
                        <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['codi'] ?> </p>
                    </div>
                </div>

                <div class="col-span-3 grid grid-cols-12 mt-3">
                    <div class="col-span-12 grid-cols-12 text-left px-2">
                        <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.pobl'))?>: </p>
                        <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['id_poblacio'] ?> </p>
                    </div>
                </div>

                <div class="col-span-6 grid grid-cols-12 mt-3">
                    <div class="col-span-12 grid-cols-12 text-left px-2">
                        <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.phone'))?>: </p>
                        <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['telefon'] ?> </p>
                    </div>
                </div>

                <div class="col-span-6 grid grid-cols-12 mt-3">
                    <div class="col-span-12 grid-cols-12 text-left px-2">
                        <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.email'))?>: </p>
                        <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['correu_persona_contacte'] ?> </p>
                    </div>
                </div>

                <div class="col-span-12 grid grid-cols-12 mt-3">
                    <div class="col-span-12 grid-cols-12 text-left px-2">
                        <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.adress'))?>: </p>
                        <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['adreca_fisica'] ?> </p>
                    </div>
                </div>

            </div>
        </div>

        <div class="h-6"></div>
    </aside>

</main>

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
                icon: 'success',
                showConfirmButton: false,
                timer:2000,
            }).then(() => {
                document.getElementById('form').submit();
            });
        }
    });
});
</script>


<?= $this->endSection() ?>