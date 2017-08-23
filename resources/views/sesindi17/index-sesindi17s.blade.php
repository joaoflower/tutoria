                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Num. Mat.</th>
                                                <th>Apellidos y Nombres</th>
                                                <th>Nro. Sesión</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($sesindi17s as $sesindi)
                                            <tr>
                                                <td>{{ $sesindi->num_mat }}</td>
                                                <td>{{ ucwords(strtolower($sesindi->name)) }}</td>
                                                <td>{{ $sesindi->nro_ses }}</td>
                                                <td>{{ $sesindi->fecha }}</td>
                                                <td>
                                                    <a href="{{ route('sesindi17.edit', $sesindi->id) }}" class="icon-edit" data-toggle="tooltip" data-placement="left" title="Editar">
                                                        <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="#" onclick="dropSesindi17({{ $sesindi->id }})" class="icon-drop" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                                                    </a>                                                   
                                                </td>
                                            </tr>
                                        @endforeach                                            
                                        </tbody>
                                    </table>