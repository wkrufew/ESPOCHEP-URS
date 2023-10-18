<x-admin-layout>
    
    <div class="container flex flex-col justify-center items-center h-[90vh]">
        <div>
            <span class="text-xl font-bold uppercase">Bienvenido Administrador</span>
        </div>
        <div class="bg-white rounded-md p-6 mt-10">
            <div>
                <div>
                    <span class=" font-bold">EXPORTAR COBERTURA DE LEVANTAMIENTO POR FASE</span>
                </div>
                <div class="mt-6">
                    <div class="mb-6">
                        @if (Session::has('error'))
                            <div class="alert alert-danger text-red-500 text-sm">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('admin.asignacion-exportar.index') }}" method="GET">
                        @csrf
                        <label class="w-full" for="phase">Selecciona la fase:</label>
                        <select name="phase" id="phase" class="broder border-gray-400 rounded-md">
                            @foreach ($phases as $phase)
                                <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                            @endforeach
                        </select>
                        <div class="mt-10 flex justify-center">
                            <button type="submit" class="px-3 py-2 rounded-md bg-blue-500 text-white">Exportar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-10">
                <hr>
                <div class="flex justify-center mt-6">
                    <span class="font-bold">EXPORTAR CERTIFICADOS</span>
                </div>
                <div class="mt-6">
                    <div class="mb-6">
                        @if (Session::has('error'))
                            <div class="alert alert-danger text-red-500 text-sm">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('admin.certificados-exportar.index') }}" method="GET">
                        @csrf
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <label for="start_date">Fecha de Inicio:</label>
                                <input class="border border-gray-300 rounded-md" type="date" name="start_date" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="end_date">Fecha de Fin:</label>
                                <input class="border border-gray-300 rounded-md" type="date" name="end_date" required>
                            </div>
                        </div>
                        <div class="mt-10 flex justify-center">
                            <button type="submit" class="px-3 py-2 rounded-md bg-green-500 text-white">Exportar
                                Certificados</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-10">
                <hr>
                <div class="flex justify-center mt-6">
                    <span class=" font-bold">EXPORTAR STICKERS</span>
                </div>
                <div class="mt-6">
                    <div class="mb-6">
                        @if (Session::has('error'))
                            <div class="alert alert-danger text-red-500 text-sm">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('admin.stickers-exportar.index') }}" method="GET">
                        @csrf
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <label for="start_date">Fecha de Inicio:</label>
                                <input class="border border-gray-300 rounded-md" type="date" name="start_date" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="end_date">Fecha de Fin:</label>
                                <input class="border border-gray-300 rounded-md" type="date" name="end_date" required>
                            </div>
                        </div>
                        <div class="mt-10 flex justify-center">
                            <button type="submit" class="px-3 py-2 rounded-md bg-sky-500 text-white">Exportar
                                Stickers</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <div class="loader" id="loader-6">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <div class="flex justify-center items-center absolute mt-32">
                    <p class="text-[#3e3e66] text-sm font-semibold text-center relative">Enviando el formulario...</p>
                </div>
            </div>
            <script>
                window.addEventListener("load", () => {
                        const loader = document.querySelector(".loader");
                        loader.classList.add("loader--hidden");
                        loader.addEventListener("transitionend", () => {
                            document.body.removeChild(loader);
                        });
                    });
            </script>
        </div>
    </div>
</x-admin-layout>
