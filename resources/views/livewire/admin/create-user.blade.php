<div class="">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center bg-gray-100 ">
        <div class="relative sm:max-w-sm w-full">
            <div class="card bg-blue-400 shadow-lg  w-full h-full rounded-3xl absolute  transform -rotate-6"></div>
            <div class="card bg-red-400 shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
            <div class="relative w-full rounded-3xl  px-6 py-4 bg-gray-100 shadow-md">
                <label for="" class="block mt-3 text-sm text-gray-700 text-center font-semibold">
                    Registrar Usuario
                </label>
                <form wire:submit="save">          
                    <div>
                        <x-label>
                            Nombres
                        </x-label>
                        <x-input wire:model="name" type="text" class="w-full mt-1" />
                        <x-input-error for="name" />
                    </div>
        
                    <div class="mt-7">                
                        <x-label>
                            Correo
                        </x-label>
                        <x-input wire:model="email" type="email" class="w-full mt-1" />
                        <x-input-error for="email" />
                    </div>

                    <div class="mt-7">                
                        <x-label>
                            Contraseña
                        </x-label>
                        <x-input wire:model="password" type="text" class="w-full mt-1" />
                        <x-input-error for="password" />
                    </div>

                    <div class="mt-7">
                        <button type="submit" class="bg-blue-500 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                            Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>