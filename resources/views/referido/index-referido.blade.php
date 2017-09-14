                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Escuela Profesional</th>
                                                <th>Tutor </th>
                                                <th>Num. Mat.</th>
                                                <th>Tutorado</th>
                                                <th>Referido a</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($grupos->count() > 0)
                                        @foreach ($grupos as $grupo)
                                            @foreach ($grupo->estugrupos as $estugrupo)
                                                @foreach ($estugrupo->sesindi17s as $sesindi17)
                                                    @foreach ($sesindi17->sesindi17refs as $sesindi17ref)
                                                        @if($sesindi17ref->atencionref == null)
                                            <tr>
                                                <td>{{ ucwords(strtolower( $estugrupo->carrera )) }}</td>
                                                <td>{{ ucwords(strtolower( $grupo->docente )) }}</td>
                                                <td>{{ ucwords(strtolower( $estugrupo->num_mat )) }}</td>
                                                <td>{{ ucwords(strtolower( $estugrupo->estudiante )) }}</td>
                                                <td>{{ $sesindi17ref->itemreferido->name }}</td>
                                                <td>
                                                    {!! Form::button('<i class="fa fa-hand-paper-o fa-lg" aria-hidden="true"></i> <span>Atender</span>', ['type' => 'button', 'class' => 'icon-new btn-icon-table new-atencion', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Atender a estudiante', 'data-referido-id' => $sesindi17ref->id]) !!}
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