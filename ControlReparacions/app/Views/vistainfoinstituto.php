<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl text-primario mt-14">Información de Institutos</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-7">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-bold cursor-pointer" onclick="document.getElementById('info_instituto1').classList.toggle('hidden')">CAPARRELLA</h2>
        <p class="text-gray-700 hidden" id="info_instituto1">Información sobre CAPARRELLA...</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-bold cursor-pointer" onclick="document.getElementById('info_instituto2').classList.toggle('hidden')">LERIDA</h2>
        <p class="text-gray-700 hidden" id="info_instituto2">Información sobre el LERIDA...</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-bold cursor-pointer" onclick="document.getElementById('info_instituto3').classList.toggle('hidden')">CAPON</h2>
        <p class="text-gray-700 hidden" id="info_instituto3">Información sobre el CAPON...</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md mt-6">
        <h2 class="text-lg font-bold cursor-pointer" onclick="document.getElementById('info_instituto4').classList.toggle('hidden')">CAPON</h2>
        <p class="text-gray-700 hidden" id="info_instituto4">Información sobre el CAPON2...</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md mt-6">
        <h2 class="text-lg font-bold cursor-pointer" onclick="document.getElementById('info_instituto5').classList.toggle('hidden')">CAPON</h2>
        <p class="text-gray-700 hidden" id="info_instituto5">Información sobre el CAPON3...</p>
    </div>
</div>



<?= $this->endSection() ?>
