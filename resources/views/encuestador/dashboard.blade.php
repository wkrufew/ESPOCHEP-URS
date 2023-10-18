<x-encuestador-layout>
    <div class="container flex flex-col justify-center items-center h-[90vh]">
        <div>
            <span class="text-xl font-bold uppercase">Bienvenido Encuestador</span>
        </div>
        <div class="bg-white rounded-md p-6 mt-10">
            <div>
                <span class=" font-bold">IMPORTAR COBERTURA POR FASE</span>
            </div>
            <div class="mt-6">
                <div class="mb-6">
                    @if (Session::has('error'))
                        <div class="alert alert-danger text-red-500 text-sm">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
                <form action="{{ route('encuestador.exportar-cobertura.index') }}" method="GET">
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
    </div>
</x-encuestador-layout>
