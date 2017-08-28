@extends('layouts.app17')

@section('title','Perfil')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-success">
                        <h3 class="portlet-title">
                            PERFIL - Ayudanos a ayudarte, actualiza tu información para la Tutoría
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                        {!! Form::open(['route' => 'perfile.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                            
                            <div class="form-group">                                
                                {!! Form::label('fec_nac', 'Fecha de nacimiento :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::date('fec_nac', $tutorado->fec_nac, ['class' => 'form-control', 'required', 'placeholder' => 'aaaa-mm-dd']) !!}
                                </div>
                                {!! Form::label('emer_nom', 'En caso de emergencia comunicarnos con :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-3">
                                    {!! Form::text('emer_nom', $tutorado->emer_nom, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre del contacto']) !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::text('emer_cel', $tutorado->emer_cel, ['class' => 'form-control', 'required', 'placeholder' => 'Celular', 'size' => '9', 'maxlength' => '9' ]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('disca_if', '¿Tienes alguna discapacidad? :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-1">
                                    {!! Form::select('disca_if', ['' => '', 'SI' => 'Si', 'NO' => 'No'], $tutorado->disca_if, ['class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::select('disca_des', ['' => 'Seleccione la discapacidad', 'VISUAL' => 'Visual', 'AUDITIVA' => 'Auditiva', 'MOTORA' => 'Motora', 'OTRO' => 'Otro'], $tutorado->disca_des, ['class' => 'form-control', 'disabled', 'id' => 'disca_des']) !!}
                                </div>
                                 {!! Form::label('enfer_if', '¿Presentas alguna enfermedad crónica? :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-1">
                                    {!! Form::select('enfer_if', ['' => '', 'SI' => 'Si', 'NO' => 'No'], $tutorado->enfer_if, ['class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::text('enfer_des', $tutorado->enfer_des, ['class' => 'form-control', 'placeholder' => 'Especifica la enfermedad', 'size' => '20', 'maxlength' => '20', 'disabled', 'id' => 'enfer_des' ]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('salud_if', '¿Tienes Buena salud? :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-1">
                                    {!! Form::select('salud_if', ['' => '', 'SI' => 'Si', 'NO' => 'No'], $tutorado->salud_if, ['class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::text('salud_des', $tutorado->salud_des, ['class' => 'form-control', 'placeholder' => 'Especifique el problema de salud', 'size' => '20', 'maxlength' => '20', 'disabled', 'id' => 'salud_des' ]) !!}
                                </div>                                
                                {!! Form::label('con_vive', '¿Con quienes Vives? :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::select('con_vive', ['' => '', 'SOLO' => 'Solo', 'FAMILIA' => 'Con Familia'], $tutorado->con_vive, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('provincia', 'Lugar de procedencia :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-2">
                                     {!! Form::text('pro_dep', $tutorado->pro_dep, ['class' => 'form-control', 'required', 'placeholder' => 'Departamento', 'size' => '20', 'maxlength' => '20']) !!}
                                </div>
                                <div class="col-sm-2">
                                     {!! Form::text('pro_pro', $tutorado->pro_pro, ['class' => 'form-control', 'required', 'placeholder' => 'Provincia', 'size' => '20', 'maxlength' => '20']) !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::text('pro_dis', $tutorado->pro_dis, ['class' => 'form-control', 'required', 'placeholder' => 'Distrito', 'size' => '20', 'maxlength' => '20']) !!}
                                </div>                                
                                <div class="col-sm-3">
                                    {!! Form::text('com_par', $tutorado->com_par, ['class' => 'form-control', 'required', 'placeholder' => 'Barrio/Comunidad/parcialidad/centro de poblado', 'size' => '20', 'maxlength' => '20']) !!}
                                </div>
                                <div class="col-sm-1">
                                
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('resi_dir', '¿Donde es tu residencia actual? :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-3">
                                    {!! Form::text('resi_dir', $tutorado->resi_dir, ['class' => 'form-control', 'required', 'placeholder' => 'Dirección', 'size' => '50', 'maxlength' => '50']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::text('resi_ref', $tutorado->resi_ref, ['class' => 'form-control', 'required', 'placeholder' => 'Referencia de la dirección', 'size' => '50', 'maxlength' => '50']) !!}
                                </div>
                                {!! Form::label('resi_tipo', 'Tipo :', ['class' => 'col-md-1 control-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::select('resi_tipo', ['' => '', 'PROPIA' => 'Propia', 'FAMILIAR' => 'Familiar', 'ALQUILADA' => 'Alquilada', 'RESIDENCIA UNIVERSITARIA' => 'Residencia Universitaria', 'OTRO' => 'Otro'], $tutorado->resi_tipo, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">                                
                                {!! Form::label('depe_eco', '¿De quién dependes económicamente? :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-3">
                                    {!! Form::select('depe_eco', ['' => '', 'AMBOS PADRES' => 'Ambos padres', 'PADRE' => 'Solo padre', 'MADRE' => 'Solo madre', 'OTRO FAMILIAR' => 'Otro familiar', 'AUTOSOSTENIMIENTO' => 'Autosostenimiento', 'OTRO' => 'Otro'], $tutorado->depe_eco, ['class' => 'form-control', 'required']) !!}
                                </div>
                                {!! Form::label('situ_aca', 'Situación Académica del semestre anterior :', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-sm-3">
                                    {!! Form::select('situ_aca', ['' => '', 'INGRESANTE' => 'Soy Ingresante', 'INVICTO' => 'Invicto','1 CURSO' => '1 curso desaprobado', '2 CURSOS' => '2 cursos desaprobados', '3+ CURSOS' => '3 a más cursos desaprobados', 'REINCORPORADO' => 'Me reincorpore a la universidad'], $tutorado->situ_aca, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('ayu_tutoria', '¿En qué aspecto de tu vida universitaria puede ayudarte la Tutoría? :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('ayu_tutoria', $tutorado->ayu_tutoria, ['class' => 'form-control', 'placeholder' => 'Describe toda la ayuda que necesitas en el presente semestre', 'style' => 'display: none;', 'id' => 'ayu_tutoria', 'required']) !!}
                                    <div id="div-ayu_tutoria" class="summernote"></div>
                                </div>
                                <div class="col-sm-8">
                                    
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-5 col-sm-7">                                        
                                    <a href="{{ route('perfile.index') }}" class="btn btn-danger btn-rounded btn-custom btn-lg m-b-5">
                                        <i class="fa fa-times"></i> <span>Cancelar</span>
                                    </a>
                                    {!! Form::button('<i class="fa fa-arrow-right"></i> <span>Siguiente</span>', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5']) !!}  
                                </div>
                            </div>
                        {!! Form::close() !!}

                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
  
@endsection
@section('js')
<script type="text/javascript">
    $( function() {
        $("#fec_nac").datepicker({
            changeMonth: true,
            changeYear: true,
            minDate: "1970-01-01",
            maxDate: "2001-12-31"
        });
        $('#div-ayu_tutoria').summernote({
            placeholder: 'Describe toda la ayuda que necesitas en el presente semestre',
            disableDragAndDrop: true,
            height: 100, 
            minHeight: 50, 
            maxHeight: 200, 
            lang: 'es-ES',
            disableResizeEditor: false,
            toolbar: [
                ['style', ['bold', 'italic', 'underline']],
                ['color', ['color']],
                ['para', ['paragraph']],
                ['vineta', ['ul', 'ol']],
                ['misc', ['undo', 'redo']]
            ],
        });     
    });
    $(document).on('ready', function(){
        $("#disca_if").change(event => { 
            if($("#disca_if").val() == 'SI') {
                $("#disca_des").prop('required', true);
                $("#disca_des").prop('disabled', false);
            } else {                
                $("#disca_des").prop('required', false);
                $("#disca_des").prop('disabled', true);
            }
        });
        $("#enfer_if").change(event => {
            if($("#enfer_if").val() == 'SI')  {
                $("#enfer_des").prop('required', true);
                $("#enfer_des").prop('disabled', false);
            } else {
                $("#enfer_des").prop('required', false);
                $("#enfer_des").prop('disabled', true);
            }
        });
        $("#salud_if").change(event => { 
            if($("#salud_if").val() == 'SI') {
                $("#salud_des").prop('required', false);
                $("#salud_des").prop('disabled', true);                
            } else {
                $("#salud_des").prop('required', true);
                $("#salud_des").prop('disabled', false);
            }
        });
        $('#div-ayu_tutoria').summernote("code", $("#ayu_tutoria").val());
        $('#div-ayu_tutoria').on('summernote.blur', function() {
            $("#ayu_tutoria").val($(this).summernote("code"));    
        });
    });
</script>
@endsection