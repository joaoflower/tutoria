                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Escuela Profesional</th>
                                                <th>Tutor </th>
                                                <th>Num. Mat.</th>
                                                <th>Tutorado</th>
                                                <th>Referido a</th>
                                                <th>Atendido</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($grupos->count() > 0)
                                        @foreach ($grupos as $grupo)
                                            @foreach ($grupo->estugrupos as $estugrupo)
                                                @foreach ($estugrupo->sesindi17s as $sesindi17)
                                                    @foreach ($sesindi17->sesindi17refs as $sesindi17ref)
                                                        @if($sesindi17ref->atencionref != null)
                                            <tr>
                                                <td>{{ ucwords(strtolower( $estugrupo->carrera )) }}</td>
                                                <td>{{ ucwords(strtolower( $grupo->docente )) }}</td>
                                                <td>{{ ucwords(strtolower( $estugrupo->num_mat )) }}</td>
                                                <td>{{ ucwords(strtolower( $estugrupo->estudiante )) }}</td>
                                                <td>{{ $sesindi17ref->itemreferido->name }}</td>
                                                <td id="td-{{$sesindi17ref->atencionref->id}}">{{ ucwords($sesindi17ref->atencionref->atendido) }}</td>
                                                <td>
                                                    {!! Form::button('<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> <span>Modificar</span>', ['type' => 'button', 'class' => 'icon-edit btn-icon-table edit-atencion', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Modificar atención', 'data-atencion-id' => $sesindi17ref->atencionref->id]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> <span>Borrar</span>', ['type' => 'button', 'class' => 'icon-drop btn-icon-table drop-atencion', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Borrar atención', 'data-atencion-id' => $sesindi17ref->atencionref->id]) !!}
                                                </td>
                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach                                            
                                        @endif
                                        </tbody>
                                    </table>