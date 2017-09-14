                                        @php
                                            $buttonid = "button-".$planobjetivo->id;
                                        @endphp
                                        <tbody id="tbody-{{$planobjetivo->id}}">
                                            <tr>
                                                <th colspan="7" id="objetivo-{{$planobjetivo->id}}">OBJETIVO: {{$planobjetivo->objetivo}}</th>
                                                <th colspan="3">
                                                    {!! Form::button('<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>', ['type' => 'button', 'class' => 'icon-edit btn-cronograma edit-objetivo',  'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Modificar objetivo', 'data-objetivo-id' => $planobjetivo->id, 'data-objetivo' => $planobjetivo->objetivo, 'id' => $buttonid ]) !!}

                                                    {!! Form::button('<i class="fa fa-tasks fa-lg" aria-hidden="true"></i>', ['type' => 'button', 'class' => 'icon-new btn-cronograma new-actividad',  'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Nueva actividad', 'data-objetivo-id' => $planobjetivo->id, 'id' => $buttonid ]) !!}
                                                </th>
                                            </tr>    
                                        </tbody>