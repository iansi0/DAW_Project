<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<main class=" h-full">

    <div class="flex justify-between items-center mb-1">

        <h1 class="text-left text-5xl text-primario"><?= strtoupper(lang('titles.config')) ?></h1>

    </div>

    <aside>
        <div class="shadow-xl border-b grid grid-cols-12 border-primario rounded-t-xl">

            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-semibold">INFO</h2>
            </div>

            <!-- info profe  -->
            <div class="col-span-6 grid grid-cols-12  mt-2 p-4">

                <div class="col-span-12 ">
                    <h2 class="text-2xl font-semibold">USER</h2>
                </div>

                <div class="grid col-span-12 grid-cols-12  p-4">
                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">NAME: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $teacher['nom'] ?> </p>
                        </div>
                    </div>

                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">COGNOMS: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $teacher['cognoms'] ?> </p>
                        </div>
                    </div>
                </div>

                <div class="grid col-span-12 grid-cols-12  p-4">
                    <div class="col-span-12 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">EMAIL: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $user['user'] ?> </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- info insti  -->
            <div class="col-span-6 grid grid-cols-12 mt-2 p-4 ">

                <div class="col-span-12 ">
                    <h2 class="text-2xl font-semibold">INSTITUT</h2>
                </div>

                <div class="grid col-span-12 grid-cols-12  p-4">
                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">NAME: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['nom'] ?> </p>
                        </div>
                    </div>

                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">CODI: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['codi'] ?> </p>
                        </div>
                    </div>
                </div>

                <div class="grid col-span-12 grid-cols-12  p-4">
                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">TELEFON: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['telefon'] ?> </p>
                        </div>
                    </div>

                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">ADREÇA: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['adreca_fisica'] ?> </p>
                        </div>
                    </div>
                </div>

                <div class="grid col-span-12 grid-cols-12 mt-2 p-4">
                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">POBLACIO: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['id_poblacio'] ?> </p>
                        </div>
                    </div>

                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">CORREU: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $institute['correu_persona_contacte'] ?> </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </aside>

</main>


<?= $this->endSection() ?>