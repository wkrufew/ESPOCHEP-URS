<x-admin-layout>
    <div class="max-w-5xl mx-auto mt-4">
        <div class="flex flex-col justify-center">
            <div class="bg-white rounded-md p-4 max-w-5xl">
                <div class="text-xl font-bold uppercase text-center flex justify-center mb-10">Importar Usarios</div>
                <div class="my-4">
                    @if (isset($errors) && $errors->any())
                        <div class="bg-white rounded-md p-4 max-w-5xl mb-4">
                            @foreach ($errors->all() as $error)
                                <div class="text-red-500 text-sm">
                                    {{ $error }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <form action="{{ route('admin.usuarios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex justify-center">
                        <input type="file" name="import_file">
                    </div>
                    <div class="mt-6 flex justify-center">
                        <button class="bg-blue-500 rounded-md text-white text-sm px-3 py-2"
                            type="submit">Importar Usuarios</button>
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
</x-admin-layout>