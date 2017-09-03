                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Coordinador</th>
                                                <th>Escuela Profesional</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($usuheads as $usuhead)
                                            <tr>
                                                <td>{{ $usuhead->codigo }}</td>
                                                <td>{{ ucwords(strtolower($usuhead->name)) }}</td>
                                                <td>{{ ucwords(strtolower($usuhead->car_des)) }}</td>
                                                <td>
                                                    {!! Form::button('<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>', ['type' => 'button', 'class' => 'icon-edit btn-icon-table edit-coordinador', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Modificar coordinador', 'data-coordinador-id' => $usuhead->id]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>', ['type' => 'button', 'class' => 'icon-drop btn-icon-table drop-coordinador', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Borrar coordinador', 'data-coordinador-id' => $usuhead->id]) !!}
                                                </td>
                                            </tr>
                                        @endforeach                                            
                                        </tbody>
                                    </table>
