<?php

namespace App\Livewire\Calidad;

use App\Models\Certificado;
use App\Models\Seguimiento;
use App\Models\Worker;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateSeguimiento extends Component
{
    public $planificaciones = [];
    public $dia;
    public $fecha_seguimiento;
    public $observacion;
    public $tipo = "";
    public $planning_id = "";
    public $certificado_id = "";
    public $usuario;
    public $asignacion_datos;
    public $tipoSeleccionado = false;
    public $datos_encuestador;
    public $mensaje = "";
    ////PARA EL BSUCADOR
    public $search = '';
    public $selectedCertificado = null;
    public $limit = 5;

    ///CALIFICACION SEGUIMIENTO
    public $registro_nombres = null;
    public $registro_sexo = null;
    public $registro_nacimiento = null;
    public $registro_cedula = null;
    public $registro_aparentesco_hogar = null;
    public $registro_nucleos = null;
    public $registro_aparentesco_nucleo = null;
    //CALIFICACION INSITUS
    public $ubicacion = null;
    public $presentacion = null;
    public $objetivo = null;
    public $tipo_vivienda = null;
    public $diligencia_preguntas = null;
    public $miembros_hogar = null;
    public $numero_nucleos = null;
    public $registro_certificado = null;
    public $formulario_imagenes = null;

    public $open = false;

    public function updatedSearch($value)
    {
        if ($value) {
            $this->open = true;
        } else {
            $this->open = false;
        }
    }

    public function seleccionarCertificado($certificadoId)
    {
        $this->selectedCertificado = Certificado::find($certificadoId);
        $this->datos_encuestador = Worker::where('certificado_id', $this->selectedCertificado->id)->first();
        $this->search = '';
    }

    public function mount()
    {
        $this->usuario = auth()->user();
    }

    public function updatedTipo($value)
    {
        if ($value) {
            $this->tipoSeleccionado = true;
        }
    }

    public function save()
    {
        
        $this->validate([
            'tipo' => 'required',
            'observacion' => 'required',
            'selectedCertificado' => 'required',//|unique:seguimientos,certificado_id
        ]);

        $seguimiento = new Seguimiento([
            'user_id' => $this->usuario->id,
            'tipo' => $this->tipo,
            'fecha_seguimiento' => $this->datos_encuestador->fecha_encuesta,
            'planning_id' => $this->datos_encuestador->planning->id,
            'certificado_id' => $this->selectedCertificado->id,
            'observacion' => $this->observacion,
        ]);

        if ($this->tipo == 'Seguimiento') {
            $this->validate([
                'registro_nombres' => 'required',
                'registro_sexo' => 'required',
                'registro_nacimiento' => 'required',
                'registro_cedula' => 'required',
                'registro_aparentesco_hogar' => 'required',
                'registro_nucleos' => 'required',
                'registro_aparentesco_nucleo' => 'required',
            ]);

            $seguimiento->ubicacion = null;
            $seguimiento->presentacion = null;
            $seguimiento->objetivo = null;
            $seguimiento->tipo_vivienda = null;
            $seguimiento->diligencia_preguntas = null;
            $seguimiento->miembros_hogar = null;
            $seguimiento->numero_nucleos = null;
            $seguimiento->registro_certificado = null;
            $seguimiento->formulario_imagenes = null;

            $seguimiento->registro_nombres = $this->registro_nombres;
            $seguimiento->registro_sexo = $this->registro_sexo;
            $seguimiento->registro_nacimiento = $this->registro_nacimiento;
            $seguimiento->registro_cedula = $this->registro_cedula;
            $seguimiento->registro_aparentesco_hogar = $this->registro_aparentesco_hogar;
            $seguimiento->registro_nucleos = $this->registro_nucleos;
            $seguimiento->registro_aparentesco_nucleo = $this->registro_aparentesco_nucleo;
        }elseif ($this->tipo == 'Supervision') {
            $this->validate([
                'ubicacion' => 'required',
                'presentacion' => 'required',
                'objetivo' => 'required',
                'tipo_vivienda' => 'required',
                'diligencia_preguntas' => 'required',
                'miembros_hogar' => 'required',
                'numero_nucleos' => 'required',
                'registro_certificado' => 'required',
                'formulario_imagenes' => 'required',
            ]);
            $seguimiento->registro_nombres = null;
            $seguimiento->registro_sexo = null;
            $seguimiento->registro_nacimiento = null;
            $seguimiento->registro_cedula = null;
            $seguimiento->registro_aparentesco_hogar = null;
            $seguimiento->registro_nucleos = null;
            $seguimiento->registro_aparentesco_nucleo = null;

            $seguimiento->ubicacion = $this->ubicacion;
            $seguimiento->presentacion = $this->presentacion;
            $seguimiento->objetivo = $this->objetivo;
            $seguimiento->tipo_vivienda = $this->tipo_vivienda;
            $seguimiento->diligencia_preguntas = $this->diligencia_preguntas;
            $seguimiento->miembros_hogar = $this->miembros_hogar;
            $seguimiento->numero_nucleos = $this->numero_nucleos;
            $seguimiento->registro_certificado = $this->registro_certificado;
            $seguimiento->formulario_imagenes = $this->formulario_imagenes;
        }
        
        $seguimiento->save();
        
        $this->reset(['usuario', 'selectedCertificado', 'observacion','tipo']);
        return redirect()->route('calidad.seguimientos.index');
    }

    #[Layout('layouts.calidad')]
    public function render()
    {
        $certificados = [];
        if ($this->tipoSeleccionado) {
            $certificados = Certificado::where('status', 'Ocupado')
                ->where('code', 'LIKE', '%' . $this->search . '%')
                ->limit($this->limit)
                ->get();
        }
        return view('livewire.calidad.create-seguimiento', ['certificados' => $certificados]);
    }
}
