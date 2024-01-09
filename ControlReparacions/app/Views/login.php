<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
    </head>

    <body>
        <header>
            <h2 class="logo">EGMA SOLUTIONS</h2>
            <!-- esta es la parte del header que va al lado isquierdo -->
        </header>

        <div class="container" id="container">
            <!-- esto va a la parte izquierda  -->
            <div class="form-container sign-in">
                <form>
                    <h1>Login</h1>
                    <div class="social-icons">
                        <!-- aca poner los iconos de bootstrap o de otro... una manera  rapida de iniciar session en cuadraditos pequeños -->
                        <a href="#" class="icon">google</a>
                        <a href="#" class="icon">facebook</a>
                        <a href="#" class="icon">github</a>
                        <a href="#" class="icon">linkedin-in</a>
                    </div>

                    <span>use su correo electronico y su password</span>
                    <input type="email" placeholder="Email" />
                    <input type="password" placeholder="Password" />
                    <a href="#">a olvidado su password</a>
                    <button>iniciar session</button>
                </form>
            </div>

            <div class="container-derecho">
                <div class="container-derecho-bienvenido">
                    <!-- esta es la parte ira al lado derecho  junto al login  la primera vista-->
                    <div class="panel-bienvenido">
                        <h1>Bienvenido nuevamente</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>