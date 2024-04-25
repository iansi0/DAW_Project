<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r   text-white">
    <div class="text-center p-12 bg-white shadow-2xl rounded-lg text-gray-800 transform transition duration-500 hover:scale-105">
        <h1 class="text-5xl font-bold mb-6">Estamos Mejorando</h1>
        <p class="mb-6 text-xl">Nos disculpamos por los inconvenientes, estamos trabajando para hacer nuestro sitio mejor para ti.</p>
        <img src="<?= base_url('/assets/img/reparacion.jpg') ?>" alt="Mantenimiento" class="mb-6 w-full max-w-lg mx-auto">
        
        <div class="animate-bounce">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Comprueba de nuevo pronto
            </button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
