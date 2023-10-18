<x-campo-layout>
    <div class="container  flex flex-col justify-center items-center h-[90vh]">
        <div class="">
            <span class="text-xl font-bold uppercase">Bienvenido Supervisor de Campo</span>
        </div>
        <div class="bg-white rounded-md p-6 mt-10">
            <div>
                <span class=" font-bold">EXPORTAR COBERTURA POR FASE</span>
            </div>
            <div class="mt-6">
                <div class="mb-6">
                    @if (Session::has('error'))
                        <div class="alert alert-danger text-red-500 text-sm">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
                <form action="{{ route('campo.exportar-cobertura.index') }}" method="GET">
                    @csrf
                    <label class="w-full" for="phase">Selecciona la fase:</label>
                    <select name="phase" id="phase" class="broder border-gray-400 rounded-md">
                        @foreach ($phases as $phase)
                            <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                        @endforeach
                    </select>
                    <div class="mt-10 flex justify-center">
                        <button type="submit" class="px-3 py-2 rounded-md bg-blue-500 text-white">Exportar Coberturas</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-white rounded-md p-6 mt-10">
            <div>
                <span class=" font-bold">EXPORTAR COBERTURA CONSOLIDADA POR FASE</span>
            </div>
            <div class="mt-6">
                <div class="mb-6">
                    @if (Session::has('error'))
                        <div class="alert alert-danger text-red-500 text-sm">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
                <form action="{{ route('campo.exportar-coberturas-consolidadas.index') }}" method="GET">
                    @csrf
                    <label class="w-full" for="phase">Selecciona la fase:</label>
                    <select name="phase" id="phase" class="broder border-gray-400 rounded-md">
                        @foreach ($phases as $phase)
                            <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                        @endforeach
                    </select>
                    <div class="mt-10 flex justify-center">
                        <button type="submit" class="px-3 py-2 rounded-md bg-green-500 text-white">Exportar Cobertura del Equipo</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-white rounded-md p-6 mt-10">
            <div>
                <span class=" font-bold">EXPORTAR SEGUIMIENTOS Y SUPERVISIONES POR FASE</span>
            </div>
            <div class="mt-6">
                <div class="mb-6">
                    @if (Session::has('error'))
                        <div class="alert alert-danger text-red-500 text-sm">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
                <form action="{{ route('campo.exportar-seguimientos.index') }}" method="GET">
                    @csrf
                    <label class="w-full" for="phase">Selecciona la fase:</label>
                    <select name="phase" id="phase" class="broder border-gray-400 rounded-md">
                        @foreach ($phases as $phase)
                            <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                        @endforeach
                    </select>
                    <div class="mt-10 flex justify-center">
                        <button type="submit" class="px-3 py-2 rounded-md bg-blue-500 text-white">Exportar Seguimientos/Supervisiones</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-campo-layout>