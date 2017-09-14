                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Código</th>
                                                <th>Docente tutor</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($grupos as $grupo)
                                            <tr>
                                                <td>{{ $grupo->id }}</td>
                                                <td>{{ $grupo->name }}</td>
                                                <td>{{ ucwords(strtolower($grupo->paterno.' '.$grupo->materno.', '.$grupo->nombres)) }}</td>
                                                <td>
                                                    <a href="{{ route('grupo.edit', $grupo->id) }}" class="icon-edit btn-icon-table" data-toggle="tooltip" data-placement="left" title="Modificar asignación">
                                                        <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> <span>Modificar</span>
                                                    </a>
                                                    <a href="#" onclick="dropGrupo({{ $grupo->id }})" class="icon-drop btn-icon-table" data-toggle="tooltip" data-placement="top" title="Borrar asignación">
                                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> <span>Borrar</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach                                            
                                        </tbody>
                                    </table>
