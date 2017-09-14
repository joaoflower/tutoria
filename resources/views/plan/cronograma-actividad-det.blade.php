                                                <td>{{$planactividad->actividad}}</td>
                                                <td>{{$planactividad->uni_med}}</td>
                                                <td>{{$planactividad->meta}}</td>
                                                <td>{{$planactividad->mes1}}</td>
                                                <td>{{$planactividad->mes2}}</td>
                                                <td>{{$planactividad->mes3}}</td>
                                                <td>{{$planactividad->mes4}}</td>
                                                <td>{{$planactividad->mes5}}</td>
                                                <td>{{$planactividad->responsable}}</td>
                                                <td>
                                                    {!! Form::button('<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> <span>Modificar</span>', ['type' => 'button', 'class' => 'icon-edit btn-icon-table edit-actividad',  'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Modificar actividad', 'data-actividad-id' => $planactividad->id ]) !!}
                                                </td>