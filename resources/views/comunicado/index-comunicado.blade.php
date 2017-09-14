                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Escuela Profesional</th>
                                                <th>Para</th>
                                                <th>Asunto</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($comunicados as $comunicado)
                                            <tr id="tr-{{$comunicado->id}}">
                                                @include('comunicado.index-comunicado-det')
                                            </tr>
                                        @endforeach                                            
                                        </tbody>
                                    </table>
