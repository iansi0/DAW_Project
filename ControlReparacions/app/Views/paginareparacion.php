<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r from-blue-600 to-teal-500 text-white">
    <div class="text-center p-12 bg-white shadow-2xl rounded-lg text-gray-800 transform transition duration-500 hover:scale-105">
        <h1 class="text-5xl font-bold mb-6">Estamos Mejorando</h1>
        <p class="mb-6 text-xl">Nos disculpamos por los inconvenientes, estamos trabajando para hacer nuestro sitio mejor para ti.</p>
        <img src="<?= base_url('/assets/img/reparacion.jpg') ?>" alt="Mantenimiento" class="mb-6 w-full max-w-lg mx-auto">
        <div id="timer" class="text-2xl font-semibold text-gray-700 mb-4">
            <span id="hours">02</span>:<span id="minutes">00</span>:<span id="seconds">00</span>
        </div>
        <div class="animate-bounce">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Comprueba de nuevo pronto
            </button>
        </div>
    </div>
</div>

<script>
    function startTimer(duration, display) {
        var timer = duration, hours, minutes, seconds;
        setInterval(function () {
            hours = parseInt(timer / 3600, 10);
            minutes = parseInt((timer % 3600) / 60, 10);
            seconds = parseInt(timer % 60, 10);

            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = hours + ":" + minutes + ":" + seconds;

            if (--timer < 0) {
                timer = duration; 
            }
        }, 1000);
    }

    window.onload = function () {
        var countdownHours = 2 * 60 * 60, 
            display = document.querySelector('#timer');
        startTimer(countdownHours, display);
    };
    
</script>
<?= $this->endSection() ?>
