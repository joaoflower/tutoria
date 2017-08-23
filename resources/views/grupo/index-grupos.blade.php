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
                                                    <a href="{{ route('grupo.edit', $grupo->id) }}" class="icon-edit" data-toggle="tooltip" data-placement="left" title="Editar">
                                                        <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="#" onclick="dropGrupo({{ $grupo->id }})" class="icon-drop" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach                                            
                                        </tbody>
                                    </table>
