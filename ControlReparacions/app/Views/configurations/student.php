<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<main class="flex gap-72 px-52 py-5 h-full">

    <aside>
        <div class="shadow-xl border-b grid grid-cols-12 border-primario rounded-t-xl">

            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-semibold">INFO</h2>
            </div>

            <!-- info alumno  -->
            <div class="col-span-6 grid grid-cols-12  mt-2 p-4">

                <div class="col-span-12 ">
                    <h2 class="text-2xl font-semibold">USER</h2>
                </div>

                <div class="grid col-span-12 grid-cols-12 mt-2 p-4">
                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">NAME: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $student['nom'] ?> </p>
                        </div>
                    </div>

                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">COGNOMS: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $student['cognoms'] ?> </p>
                        </div>
                    </div>
                </div>

                <div class="grid col-span-12 grid-cols-12 mt-2 p-4">
                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">EMAIL: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $student['correo'] ?> </p>
                        </div>
                    </div>

                    <div class="col-span-6 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <p class="font-semibold text-primario">CURS: </p>
                            <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $student['curs'] ?> </p>
                        </div>
                    </div>
                </div>


                <div class="grid col-span-12 grid-cols-12 mt-2 p-4">

                    <div class="col-span-12 grid grid-cols-12">
                        <div class="col-span-12 grid-cols-12 text-left px-2">
                            <form action="<?= base_url('config/passwd') ?>" method="POST" class="mt-4 flex flex-col gap-2 px-20">
                                <label class="font-semibold text-primario">CANVIAR CONTRASSENYA*</label>
                                <input type="password" name="passwd" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                                <?php
                                if (isset(validation_errors()['passwd'])) : ?>
                                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['passwd'] ?></p>
                                <?php endif ?>
                                <input type="submit" value="Cambiar" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <!-- info insti  -->
            <div class="col-span-6 grid grid-cols-12 mt-2 p-4 mb-[72px]">

                <div class="col-span-12 ">
                    <h2 class="text-2xl font-semibold">INSTITUT</h2>
                </div>

                <div class="grid col-span-12 grid-cols-12 mt-2 p-4">
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

                <div class="grid col-span-12 grid-cols-12 mt-2 p-4">
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