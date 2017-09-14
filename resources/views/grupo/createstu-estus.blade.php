                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Num. Mat.</th>
                                                <th>Apellidos y nombres</th>
                                                <th>Escuela Profesional</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($estugrupos as $estugrupo)
                                            <tr>
                                                <td>{{ $estugrupo->num_mat }}</td>
                                                <td>{{ ucwords(strtolower($estugrupo->paterno.' '.$estugrupo->materno.', '.$estugrupo->nombres)) }}</td>
                                                <td>{{ ucwords(strtolower($estugrupo->car_des)) }}</td>
                                                <td>
                                                    <a href="#" onclick="dropEstudiante({{ $estugrupo->id }})" class="icon-drop btn-icon-table" data-toggle="tooltip" data-placement="top" title="Borrar">
                                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> <span>Borrar</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach                                            
                                        </tbody>
                                    </table>
