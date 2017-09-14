                                        @foreach ($planobjetivos as $planobjetivo)
                                            <tr>
                                                <th colspan="7" id="objetivo-{{$planobjetivo->id}}">OBJETIVO: {{$planobjetivo->objetivo}}</th>
                                                <th colspan="3">
                                                    {!! Form::button('<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>', ['type' => 'button', 'class' => 'icon-edit btn-cronograma edit-objetivo',  'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Modificar objetivo', 'data-id' => $planobjetivo->id, 'data-objetivo' => $planobjetivo->objetivo]) !!}

                                                    {!! Form::button('<i class="fa fa-tasks fa-lg" aria-hidden="true"></i>', ['type' => 'button', 'class' => 'icon-new btn-cronograma new-actividad',  'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Nueva actividad', 'data-objetivo_id' => $planobjetivo->id]) !!}
                                                </th>
                                            </tr>    
                                            @foreach ($planobjetivo->actividades as $planactividad)
                                            <tr>
                                                <td>{{$planactividad->actividad}}</td>
                                                <td>{{$planactividad->uni_med}}</td>
                                                <td>{{$planactividad->meta}}</td>
                                                <td>{{$planactividad->mes1}}</td>
                                                <td>{{$planactividad->mes2}}</td>
                                                <td>{{$planactividad->mes3}}</td>
                                                <td>{{$planactividad->mes4}}</td>
                                                <td>{{$planactividad->mes5}}</td>
                                                <td>{{$planactividad->responsable}}</td>
                                                <td></td>
                                            </tr>
                                            @endforeach
                                        @endforeach