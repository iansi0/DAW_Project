<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<main class=" h-full">

    <div class="flex justify-between items-center mb-1">

        <h1 class="text-left text-5xl text-primario"><?= mb_strtoupper(lang('titles.config')) ?></h1>

    </div>

    <aside>

        <!-- info profe  -->
        <div class="shadow-xl border-b grid grid-cols-12 border-primario rounded-t-xl">

            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-semibold"><?=mb_strtoupper(lang('forms.info')).' '.mb_strtoupper(lang('titles.prof_2'))?></h2>
            </div>

            <div class="col-span-12 grid grid-cols-12">

                <div class="grid col-span-12 grid-cols-12 p-4">
                    <div class="col-span-4 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.name'))?>: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $teacher['nom'] ?> </p>
                        </div>
                    </div>

                    <div class="col-span-4 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.email'))?>: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $teacher['cognoms'] ?> </p>
                        </div>
                    </div>

                    <div class="col-span-4 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.surnames'))?>: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $user['user'] ?> </p>
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
                        <p class="font-semibold text-primario"><?=mb_strtoupper(lang('forms.mail'))?>: </p>
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

    </aside>

</main>



<?= $this->endSection() ?>