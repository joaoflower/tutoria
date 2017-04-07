					@foreach ($estugrupos as $estugrupo)
						<tr>
							<td>{{ $estugrupo->num_mat }}</td>
							<td>{{ ucwords(strtolower($estugrupo->paterno.' '.$estugrupo->materno.', '.$estugrupo->nombres)) }}</td>
							<td>{{ ucwords(strtolower($estugrupo->car_des)) }}</td>
							<td>
								<a href="#" onclick="if(confirm('¿Estas seguro que quieres eliminar?')) {delEstudiante({{ $estugrupo->id }});} return false;" data-toggle="tooltip" data-placement="right" title="Eliminar">
									<i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
					@endforeach