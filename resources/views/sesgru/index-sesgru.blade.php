                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nro. Sesión</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($sesgrus as $sesgru)
                                            <tr>
                                                <td>{{ $sesgru->nro_ses }}</td>
                                                <td>{{ $sesgru->fecha }}</td>
                                                <td>
                                                    <a href="{{ route('sesgru.edit', $sesgru->id) }}" class="icon-edit btn-icon-table" data-toggle="tooltip" data-placement="left" title="Modificar sesión">
                                                        <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> <span>Modificar</span>
                                                    </a>
                                                    <a href="#" onclick="dropSesgru({{ $sesgru->id }})" class="icon-drop btn-icon-table" data-toggle="tooltip" data-placement="top" title="Borrar sesión">
                                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> <span>Borrar</span>
                                                    </a>                                                  
                                                </td>
                                            </tr>
                                        @endforeach                                            
                                        </tbody>
                                    </table>