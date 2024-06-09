<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<main class="flex gap-72 px-52 py-5 h-full">

    <aside class="flex flex-col gap-10">

        <div class="flex flex-col gap-5 px-10 py-5 border-2 border-black rounded-lg">
            <h1 class="text-4xl">INFO INSTI</h1>
            <p>name: <?= $sstt['nom'] ?> </p>
            <p>codi: <?= $sstt['codi'] ?> </p>
            <p>telefon: <?= $sstt['telefon'] ?> </p>
            <p>adreca: <?= $sstt['adreca_fisica'] ?> </p>
            <p>poblacio: <?= $sstt['poblacio'] ?> </p>
            <p>cp: <?= $sstt['cp'] ?> </p>
            <p>altres: <?= $sstt['altres'] ?> </p>
            <p>correu: <?= $user['user'] ?> </p>
        </div>


    </aside>

    <article>

        <form action="<?= base_url('config/sstt') ?>" method="POST" class="flex flex-col gap-5 px-10 py-5 border-2 border-black rounded-lg">


            <div class="flex flex-col mt-5">
                <label class="">Telefon</label>
                <input type="text" value="<?= $sstt['telefon'] ?>" name="phone" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['phone'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['phone'] ?></p>
                <?php endif ?>
            </div>


            <div class="flex flex-col mt-5">
                <label class="">Adreça</label>
                <input type="text" value="<?= $sstt['adreca_fisica'] ?>" name="adress" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['adress'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['adress'] ?></p>
                <?php endif ?>
            </div>


            <div class="flex flex-col mt-5">
                <label class="">Poblacio</label>
                <input type="text" value="<?= $sstt['poblacio'] ?>" name="population" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['population'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['population'] ?></p>
                <?php endif ?>
            </div>

            <div class="flex flex-col mt-5">
                <label class="">CP</label>
                <input type="text" value="<?= $sstt['cp'] ?>" name="cp" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['cp'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['cp'] ?></p>
                <?php endif ?>
            </div>

            <div class="flex flex-col mt-5">
                <label class="">Altres</label>
                <input type="text" value="<?= $sstt['altres'] ?>" name="name" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['name'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['name'] ?></p>
                <?php endif ?>
            </div>

            <input type="submit" value="Cambiar" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">
        </form>


    </article>


</main>


<?= $this->endSection() ?>