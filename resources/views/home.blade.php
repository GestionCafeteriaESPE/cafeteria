<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME</title>
    <!-- Tailwind CSS (para los estilos de la clase) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<!-- HORARIO DE ATENCIÓN -->

<body class="min-h-screen bg-white">
    <div class="bg-blue-200 text-center py-2 text-sm text-gray-700">Lunes a Sábado 2pm-8pm</div>

    <!--BARRA DE MENÚ -->
    <header id="home"class="flex flex-col md:flex-row items-center justify-between px-4 py-4 border-b">
        <div class="flex items-center space-x-4">
            <div class="text-4xl font-bold" style="color: #73616D;">ELÍAS</div>
            <div class="text-lg font-semibold" style="color: #B38184;">CAFETERÍA</div>
        </div>
        <nav class="mt-4 md:mt-0 flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-8 w-full md:w-auto">
            <a href="#home" class="text-gray-500 hover:text-gray-700 border-l border-gray-300 pl-4 first:pl-0 first:border-l-0">HOME</a>
            <a href="#menu" class="text-gray-500 hover:text-gray-700 border-l border-gray-300 pl-4 first:pl-0 last:border-l-0">MENÚ</a>
            <a href="#informacion" class="text-gray-500 hover:text-gray-700 border-l border-gray-300 pl-4 last:border-l-0">INFORMACIÓN</a>
        </nav>
        <a href="{{ route('filament.admin.auth.login') }}" class="mt-4 md:mt-0 px-4 py-2 border border-gray-500 rounded-full text-gray-500 inline-block w-full md:w-auto text-center" style="background-color: #F0B39E; color: #73616D; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            Login
        </a>

    </header>

    <!-- BANNER -->
    <main class="flex flex-col md:flex-row">
        <!-- Sección con la imagen -->
        <div class="w-full md:w-1/2 flex justify-center items-center" style="background-color: #413E49; padding: 2rem;">
            <img src="{{ asset('imagenes/logo.png') }}" class="h-64 md:h-124 w-auto" />
        </div>

        <!-- Sección con el texto -->
        <div class="w-full md:w-1/2 flex justify-center items-center" style="background-color: #F0B39E; padding: 2rem;">
            <div class="text-center">
                <div class="font-bold text-4xl md:text-8xl" style="color: #73616D;">ELÍAS</div>
                <div class="font-bold text-4xl md:text-8xl" style="color: #B38184;">CAFETERÍA</div>
            </div>
        </div>
    </main>

    <!-- SECCIÓN DE MENÚ -->
    <section id="menu" class="w-full py-12 md:py-24 lg:py-32 bg-gray-100 flex justify-center items-center">
        <div class="container mx-auto px-4 text-center">
            <div class="text-center mb-8">
                <div class="font-bold text-2xl md:text-3xl" style="color: #F0B39E;">EL MENÚ</div>
            </div>

            <!-- Categorías -->
            <div class="grid grid-cols-3 sm:grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Bebidas -->
                <div class="flex flex-col items-center gap-4">
                    <h1 class="font-semibold text-lg">Bebidas cold and hot</h1>
                    <img src="{{ asset('imagenes/bebidas.jpg') }}" alt="Bebidas" class="rounded-lg object-cover w-full h-auto" />
                    <div class="flex flex-col items-center gap-2">
                        <a href="#bebidas" style="background-color: #F7E3BE;" class="inline-flex h-8 items-center justify-center rounded-md text-white px-4 text-sm font-medium shadow transition-colors hover:bg-opacity-90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring">
                            Ver más
                        </a>
                    </div>
                </div>

                <!-- CSS para desplazamiento suave -->
                <style>
                    html {
                        scroll-behavior: smooth;
                    }
                </style>

                <!-- Postres -->
                <div class="flex flex-col items-center gap-4">
                    <h3 class="font-semibold text-lg">Postres </h3>
                    <img src="{{ asset('imagenes/postres.jpg') }}" alt="Postres" class="rounded-lg object-cover w-full h-auto" />
                    <div class="flex flex-col items-center gap-2">
                        <a href="#postres" style="background-color: #F7E3BE;" class="inline-flex h-8 items-center justify-center rounded-md text-white px-4 text-sm font-medium shadow transition-colors hover:bg-opacity-90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring">
                            Ver más
                        </a>
                    </div>
                </div>

                <!-- Bocatas y Sanduches -->
                <div class="flex flex-col items-center gap-4">
                    <h3 class="font-semibold text-lg">Bocatas y Sanduches</h3>
                    <img src="{{ asset('imagenes/sanduches.jpg') }}" alt="Bocatas y Sanduches" class="rounded-lg object-cover w-full h-auto" />
                    <div class="flex flex-col items-center gap-2">
                        <a href="#bocatas-y-sandwiches" style="background-color: #F7E3BE;" class="inline-flex h-8 items-center justify-center rounded-md text-white px-4 text-sm font-medium shadow transition-colors hover:bg-opacity-90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN DE BEBIDAS -->
    <div class="text-center py-12">
        <div class="font-bold text-2xl" style="color: #F0B39E;">BEBIDAS CALIENTES Y FRIAS</div>
    </div>
    <section id="bebidas" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto py-12">
        <!-- Items de bebidas -->
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/aromatica.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">AROMÁTICA</h3>
                <p class="text-sm text-muted-foreground">Horchata, Hierva Luisa, Cedron </p>
                <p class="text-lg font-semibold">Precio: $1.00</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/espresso.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">ESPRESSO</h3>
                <p class="text-sm text-muted-foreground">Bebida de café negro fuerte</p>
                <p class="text-lg font-semibold">Precio: $2.75</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/macchiato.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">Macchiato</h3>
                <p class="text-sm text-muted-foreground">Bebida caliente de 90% café y 10% leche.</p>
                <p class="text-lg font-semibold">Precio: $2.75</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/jugoFruta.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">JUGO DE FRUTA</h3>
                <p class="text-sm text-muted-foreground">Fresa, Melon, Piña</p>
                <p class="text-lg font-semibold">$1.00</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/batidoFruta.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">BATIDO DE FRUTA</h3>
                <p class="text-sm text-muted-foreground">Fresa, Mora, Taxo.</p>
                <p class="text-lg font-semibold">$1.00</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/latteFrio.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">LATTE FRÍO</h3>
                <p class="text-sm text-muted-foreground">Bebida a base de espresso, preparada con leche.</p>
                <p class="text-lg font-semibold">$2.75</p>
            </div>
        </div>
    </section>

    <!-- SECCIÓN DE POSTRES -->
    <div class="text-center">
        <div id="postres" class="font-bold" style="color: #F0B39E; font-size: 2rem;">POSTRES</div>
    </div>
    <section class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto py-12">
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/pastelChocolate.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">PASTEL DE CHOCOLATE</h3>
                <p class="text-sm text-muted-foreground">Pastel de chocolate, acompañado de frutos rojos </p>
                <p class="text-lg font-semibold">Precio: $3.50</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/cheesecakeMaracuya.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">CHEESECAKE DE MARACUYÁ</h3>
                <p class="text-sm text-muted-foreground">Postre con base de galleta sabor a maracuyá.</p>
                <p class="text-lg font-semibold">Precio: $3.75</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/pastelTresLeches.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">PASTEL DE TRES LECHES</h3>
                <p class="text-sm text-muted-foreground">Postre de tres leches (evaporada, condensada y media crema).</p>
                <p class="text-lg font-semibold">Precio: $2.75</p>
            </div>
        </div>

        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/waffleFrutaCrema.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">WAFFLE DE FRUTA CON CREMA</h3>
                <p class="text-sm text-muted-foreground">Crepa acompañada de una fruta a elección y crema Fruta: Fresa, Banana</p>
                <p class="text-lg font-semibold">$3.00</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/crepaChocolate.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">CREPA DE CHOCOLATE Y MERMELADA</h3>
                <p class="text-sm text-muted-foreground">Crepa con chocolate y mermelada sabor a elección, Fresa,Piña, Mora</p>
                <p class="text-lg font-semibold">$3.00</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/helado.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">HELADOS</h3>
                <p class="text-sm text-muted-foreground">Helado casero de diferentes sabores. Vainilla, Chocolate</p>
                <p class="text-lg font-semibold">$1.75</p>
            </div>
        </div>
    </section>

    <!-- SECCIÓN DE BOCASTAS Y SANDUCHES -->
    <div class="text-center">
        <div id="bocatas-y-sandwiches" class="font-bold" style="color: #F0B39E; font-size: 2rem;">BOCATAS Y SANDUCHES</div>
    </div>
    <section class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto py-12">
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/bocataJamon.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">BOCATA DE JAMÓN DE PAVO</h3>
                <p class="text-sm text-muted-foreground">Bocata de jamón de pavo, con pan casero y tomate. </p>
                <p class="text-lg font-semibold">Precio: $3.50</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/bocataPernil.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">BOCATA DE PERNIL</h3>
                <p class="text-sm text-muted-foreground">Bocata de pernil asado, con pan casero y lechuga.</p>
                <p class="text-lg font-semibold">Precio: $4.00</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/bocataRoast.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">BOCATA ROAST BEEF</h3>
                <p class="text-sm text-muted-foreground">Bocata de carne asada, con pan casero y lechuga.</p>
                <p class="text-lg font-semibold">Precio: $3.75</p>
            </div>
        </div>

        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/sanducheVerduras.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">SANDUCHE DE VERDURAS</h3>
                <p class="text-sm text-muted-foreground">Sánduche de tomate, lechuga y cebolla</p>
                <p class="text-lg font-semibold">$2.75</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/sanducheQueso.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">SANDUCHE DE QUESO Y JAMÓN</h3>
                <p class="text-sm text-muted-foreground">Sánduche de Queso Cheddar y jamón.</p>
                <p class="text-lg font-semibold">$3.00</p>
            </div>
        </div>
        <div class="bg-background rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('imagenes/sanducheIntegral.png') }}" class="w-full h-64 object-cover" />
            <div class="p-4">
                <h3 class="text-xl font-bold">SANDUCHE INTEGRAL DE JAMÓN DE PAVO</h3>
                <p class="text-sm text-muted-foreground">Sánduche de jamón de pavo, con pan integral.</p>
                <p class="text-lg font-semibold">$3.75</p>
            </div>
        </div>
    </section>

    <!-- INFORMACIÓN -->
    <div class="text-center">
        <div class="font-bold" style="color: #F0B39E; font-size: 2rem;">INFORMACIÓN</div>
    </div>

    <section id="informacion"class="py-12">
        <div class="bg-gray-700 rounded-lg p-4 mx-auto" style="background-color: #73616D; width: 100%;">
            <textarea placeholder="¡Descubre una experiencia gastronómica excepcional en nuestra cafetería! Nuestro delicioso menú ofrece una amplia variedad de sabores irresistibles, desde exquisitos cafés hasta tentadoras opciones de bocadillos y platos principales. Con ingredientes frescos y de alta calidad, cada bocado es una verdadera delicia. ¡Ven y déjate sorprender por nuestros sabores únicos y nuestra hospitalidad excepcional!" class="w-full resize-none border-none bg-transparent text-white focus:outline-none h-40 text-2xl text-center"></textarea>
        </div>

        <div class="flex justify-center items-center mt-8">
            <div class="relative w-0/4 md:w-[400px] h-auto rounded-full overflow-hidden">
                <img src="{{ asset('imagenes/coffee.gif') }}" alt="Imagen" class="object-cover w-full h-full" />
                <div class="absolute inset-0 bg-gradient-to-r from-primary to-secondary opacity-50 rounded-full"></div>
            </div>
        </div>
    </section>

    <!--INFO-->
    <section class="w-full py-8">
        <div class="w-full flex flex-wrap md:grid md:grid-cols-4 gap-4">
            <div class="bg-[#F0B39E] p-4 text-center min-w-[200px] flex-1" style="background-color: #F0B39E !important;">
                <h2 class="text-pink-700 font-semibold mb-2">Salúdanos 👋</h2>
                <p>Lunes a Sábado 2pm-8pm</p>
            </div>
            <div class="bg-[#F7E3BE] p-4 text-center min-w-[200px] flex-1" style="background-color: #F7E3BE !important;">
                <h2 class="text-pink-700 font-semibold mb-2">Ubicación</h2>
                <p><span class="font-semibold">Local</span></p>
                <p>Parque San Francisco. Quijano y Ordóñez & San Vicente Mártir</p>
            </div>
            <div class="bg-[#F0B39E] p-4 text-center min-w-[200px] flex-1" style="background-color: #F0B39E !important;">
                <h2 class="text-pink-700 font-semibold mb-2">Contacto</h2>
                <p>0963606840</p>
            </div>
            <div class="bg-[#F7E3BE] p-4 text-center min-w-[200px] flex-1" style="background-color: #F7E3BE !important;">
                <h2 class="text-pink-700 font-semibold mb-2">Nuestras Redes Sociales</h2>
                <p><span class="font-semibold">Instagram</span></p>
                <p><a href="https://www.instagram.com/eliaspasteleria" class="text-black">eliaspasteleria</a></p>
                <p><span class="font-semibold">Facebook</span></p>
                <p><a href="https://www.facebook.com/ELÍAS-pastelería-artesanal" class="text-black">ELÍAS - pastelería artesanal -</a></p>
            </div>
        </div>
    </section>

    <!--Derechos Reservados-->
    <footer class="bg-gray-800 text-white py-4 text-center">
        <div class="container mx-auto">
            <p class="text-sm">&copy; 2024 ELÍAS CAFETERÍA. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>