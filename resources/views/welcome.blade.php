<x-app-layout>
    <section>
        <div class="max-w-6xl mx-auto p-4 lg:p-2">
            <img class="w-full h-auto rounded-lg object-cover bg-contain" src="{{asset('fotos/portada_3.webp')}}" alt="portada">
        </div>
    </section>

    <section>
        <div class="max-w-6xl mx-auto px-4 lg:px-2 mt-6 pb-6">
            <div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <a {{-- href="https://laravel.com/docs" --}} class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-[#1E3F80]">
                        <div>
                            <div class="h-16 w-16 bg-[#1E3F80] flex items-center justify-center rounded-full">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M32 32c17.7 0 32 14.3 32 32V400c0 8.8 7.2 16 16 16H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H80c-44.2 0-80-35.8-80-80V64C0 46.3 14.3 32 32 32zm96 96c0-17.7 14.3-32 32-32l192 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-192 0c-17.7 0-32-14.3-32-32zm32 64H288c17.7 0 32 14.3 32 32s-14.3 32-32 32H160c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 96H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H160c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg>
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900">¿Qué es el Registro Social?</h2>

                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                Es una herramienta que permite conocer de manera real y actualizada las condiciones de vida de los ecuatorianos.
                            </p>
                        </div>
                    </a>

                    <a {{-- href="https://laracasts.com" --}} class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-[#1E3F80]">
                        <div>
                            <div class="h-16 w-16 bg-[#1E3F80] flex items-center justify-center rounded-full">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z"/></svg>
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900">Nota</h2>

                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                Le recordamos que la Unidad del Registro Social no entrega beneficios sociales ni subsidios estatales, esto lo hacen las instituciones usuarias de la base del Registro Social.
                            </p>
                        </div>
                    </a>

                    <a href="https://siirs.registrosocial.gob.ec/pages/publico/busquedaPublica.jsf?_gl=1*13bv44i*_ga*NDU5MzQxMDY0LjE2OTI2NzA3NDc.*_ga_6EV0YL3YRB*MTY5MjY3MDc0Ni4xLjEuMTY5MjY3MDc4Ni4wLjAuMA.." class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-[#1E3F80]">
                        <div>
                            <div class="h-16 w-16 bg-[#1E3F80] flex items-center justify-center rounded-full">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900">Consultar</h2>

                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                Para conocer si te encuentras registrado en la base de datos del Registro Social, ingresa tu número de cédula:
                            </p>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-[#1E3F80] w-6 h-6 mx-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
