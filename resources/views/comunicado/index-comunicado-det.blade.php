                                                <td>{{ $comunicado->id }}</td>
                                                <td>{{ ucwords(strtolower($comunicado->car_des)) }}</td>
                                                <td>{{ ucwords(strtolower($comunicado->para_des)) }}</td>
                                                <td>{{ ucwords(strtolower($comunicado->asunto)) }}</td>                                                
                                                <td>
                                                    {!! Form::button('<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>', ['type' => 'button', 'class' => 'icon-edit btn-icon-table edit-comunicado', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Modificar comunicado', 'data-comunicado-id' => $comunicado->id]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>', ['type' => 'button', 'class' => 'icon-drop btn-icon-table drop-comunicado', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Borrar comunicado', 'data-comunicado-id' => $comunicado->id]) !!}
                                                </td>