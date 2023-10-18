<x-provincial-layout>
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <div class="container flex flex-col justify-center items-center mt-10 {{-- h-[90vh] --}}">
        <div>
            <span class="md:text-xl font-semibold uppercase mt-10">Bienvenido coordinador provincial</span>
        </div>
        <div class="bg-white rounded-md p-6 mt-10">
            <div>
                <span class="font-bold">EXPORTAR COBERTURAS GENERALES POR TIPO DE SECTOR</span>
            </div>
            <div class="mt-6">
                <div class="mb-6">
                    @if (Session::has('error'))
                        <div class="alert alert-danger text-red-500 text-sm">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
                <form action="{{ route('provincial.asignacion-exportar.index') }}" method="GET">
                    @csrf
                    <label class="w-full" for="phase">Selecciona la fase:</label>
                    <select name="phase" id="phase" class="broder border-gray-400 rounded-md">
                        @foreach ($phases as $phase)
                            <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                        @endforeach
                    </select>
                    <div class="mt-10 flex justify-center">
                        <button type="submit" class="px-3 py-2 rounded-md bg-green-500 text-white">Exportar Cobertura
                            General</button>
                    </div>
                </form>
            </div>
            {{-- <div class="mt-10">
                <span class=" font-bold">EXPORTAR SEGUIMIENTOS/SUPERVISION POR FASE</span>
            </div>
            <div class="mt-6">
                <div class="mb-6">
                    @if (Session::has('error'))
                        <div class="alert alert-danger text-red-500 text-sm">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
                <form action="{{ route('gerencia.exportar-seguimiento.index') }}" method="GET">
                    @csrf
                    <label class="w-full" for="phase">Selecciona la fase:</label>
                    <select name="phase" id="phase" class="broder border-gray-400 rounded-md">
                        @foreach ($phases as $phase)
                            <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                        @endforeach
                    </select>
                    <div class="mt-10 flex justify-center">
                        <button type="submit" class="px-3 py-2 rounded-md bg-blue-500 text-white">Exportar Seguimiento Individual</button>
                    </div>
                </form>
            </div>
            <div class="mt-10">
                <span class="font-bold">EXPORTAR SEGUIMIENTOS/SUPERVISION TOTAL POR FASE</span>
            </div>
            <div class="mt-6">
                <div class="mb-6">
                    @if (Session::has('error'))
                        <div class="alert alert-danger text-red-500 text-sm">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
                <form action="{{ route('gerencia.exportar-seguimiento-total.index') }}" method="GET">
                    @csrf
                    <label class="w-full" for="phase">Selecciona la fase:</label>
                    <select name="phase" id="phase" class="broder border-gray-400 rounded-md">
                        @foreach ($phases as $phase)
                            <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                        @endforeach
                    </select>
                    <div class="mt-10 flex justify-center">
                        <button type="submit" class="px-3 py-2 rounded-md bg-sky-500 text-white">Exportar Seguimiento General</button>
                    </div>
                </form>
            </div> --}}
        </div>
    </div>
</x-provincial-layout>
