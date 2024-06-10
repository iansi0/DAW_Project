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

            <!-- info insti  -->
            <form action="<?= base_url('config/sstt') ?>" method="POST" class="col-span-12 grid grid-cols-12 mt-2 p-4 ">
                <div class="col-span-12 grid grid-cols-12 mt-2 p-4 ">


                    <div class="col-span-12 ">
                        <h2 class="text-2xl font-semibold">SSTT</h2>
                    </div>

                    <div class="grid col-span-12 grid-cols-12  p-4">
                        <div class="col-span-6 grid grid-cols-12">
                            <div class="col-span-12 grid-cols-12 text-left px-2">
                                <p class="font-semibold text-primario">NAME: </p>
                                <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $sstt['nom'] ?> </p>
                            </div>
                        </div>

                        <div class="col-span-6 grid grid-cols-12">
                            <div class="col-span-12 grid-cols-12 text-left px-2">
                                <p class="font-semibold text-primario">CODI: </p>
                                <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $sstt['codi'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="grid col-span-12 grid-cols-12  p-4">
                        <div class="col-span-6 grid grid-cols-12">
                            <div class="col-span-12 grid-cols-12 text-left px-2">
                                <p class="font-semibold text-primario">CORREU: </p>
                                <p class="border-2 border-terciario-1 text-terciario-4 w-full px-2 py-3 rounded bg-secundario "> <?= $user['user'] ?> </p>
                            </div>
                        </div>

                        <div class="col-span-6 grid grid-cols-12">
                            <div class="col-span-12 grid-cols-12 text-left px-2">
                                <label class="font-semibold text-primario">TELEFON: </label>
                                <input type="text" value="<?= $sstt['telefon'] ?>" name="phone" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                                <?php
                                if (isset(validation_errors()['phone'])) : ?>
                                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['phone'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <div class="grid col-span-12 grid-cols-12 mt-2 p-4">
                        <div class="col-span-6 grid grid-cols-12">
                            <div class="col-span-12 grid-cols-12 text-left px-2">
                                <label class="font-semibold text-primario">POBLACIO: </label>
                                <input type="text" value="<?= $sstt['poblacio'] ?>" name="population" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                                <?php
                                if (isset(validation_errors()['population'])) : ?>
                                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['population'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="col-span-6 grid grid-cols-12">
                            <div class="col-span-12 grid-cols-12 text-left px-2">
                                <label class="font-semibold text-primario">CODI POSTAL: </label>
                                <input type="text" value="<?= $sstt['cp'] ?>" name="cp" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                                <?php
                                if (isset(validation_errors()['cp'])) : ?>
                                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['cp'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <div class="grid col-span-12 grid-cols-12 mt-2 p-4">
                        <div class="col-span-6 grid grid-cols-12">
                            <div class="col-span-12 grid-cols-12 text-left px-2">
                                <label class="font-semibold text-primario">ALTRES: </label>
                                <input type="text" value="<?= $sstt['altres'] ?>" name="altres" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                                <?php
                                if (isset(validation_errors()['altres'])) : ?>
                                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['altres'] ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <div class="grid col-span-12 grid-cols-12 mt-2 p-4">
                        <div class="col-span-12 grid grid-cols-12">
                            <div class="col-span-12 grid-cols-12 text-left px-2">
                                <input type="submit" value="Cambiar" class="bg-green-700 w-full  hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">
                            </div>
                        </div>
                    </div>


                </div>
            </form>

        </div>
    </aside>

</main>


<?= $this->endSection() ?>