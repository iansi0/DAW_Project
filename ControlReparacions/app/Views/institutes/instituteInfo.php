<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>


<div class="flex gap-16 items-center bg-primario text-secundario p-3 rounded-lg pl-5 w-full mb-3">

    <a href="<?= strpos(previous_url(), 'institutes?') !== false
                    ? str_replace('index.php/', '', previous_url())
                    : base_url('/institutes'); ?>">
        <button id="pdf" class="hover:bg-light-blue hover:text-terciario-1 p-2 px-3 rounded-xl transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-arrow-left text-3xl"></i></button>
    </a>

    <h1 class=" text-left text-5xl"> <?= $institute['nom'] ?></h1>
</div>

<main class="flex gap-7 py-1 ">

    <section class="flex flex-col gap-2">

        <div class="p-5">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTscU3jYwiMibdPrr7f7S2htGvZGqUWHKr6gSuuUYKQkA&s" alt="imagen dispositivo" class="w-full">
            <iframe width="200" height="150" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBM93g6PYnAa3mlQpV2qu0Urnnc1iL4LeM&q=Space+Needle,Seattle+WA">
            </iframe>
        </div>

        <div class=" text-secundario min-w-72 max-w-80 rounded-t-lg overflow-hidden">
            <h3 class="bg-primario text-lg p-3"> Datos </h3>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-hashtag"></i> : <span class="text-sm"><?= $institute['codi'] ?></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-envelope"></i> : <span class="text-sm"><?= $institute['correu'] ?></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-person"></i> : <span class="text-sm"><?= $institute['persona'] ?></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-phone"></i> : <span class="text-sm"><?= $institute['telefon'] ?></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-location-dot"></i> : <span class="text-sm"><?= $institute['adreca'] ?></span></p>
        </div>

    </section>

    <article class="flex flex-col gap-2 w-full">

        <div>
            <div class="flex justify-between bg-primario text-secundario text-left p-3 pr-8 text-3xl rounded-t-2xl">
                <h1><?= lang('titles.ticket'); ?></h1>
                <div class="  flex align-middle mt-2 gap-3">
                    <a class="hover:font-bold <?= $filter == 'sender' ? " font-bold" : "" ?>" href="<?= base_url('institutes/'.$institute['codi'].'/filterSender') ?>"><?=lang('titles.sender')?></a>
                    <span>&nbsp;|&nbsp;</span>
                    <a class="hover:font-bold <?= $filter == 'receiver' ? " font-bold" : "" ?>" href="<?= base_url('institutes/'.$institute['codi'].'/filterReceiver') ?>"><?=lang('titles.receiver')?></a>
                </div>
            </div>

            <?php
            echo $table->generate();
            ?>
        </div>

    </article>
</main>
<?= $this->endSection() ?>