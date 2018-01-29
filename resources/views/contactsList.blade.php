@extends("default")

@section("content")
<h1 class="heading-title"> Liste des contacts </h1>
<p>
	<a type="button" class="btn btn-success" href="{{ url('contacts/add') }}">
		Ajouter un contact <span class="glyphicon glyphicon-plus"></span>
	</a>
	<a type="button" class="btn btn-info" href="{{ url('contacts/export') }}">
		Exporter la liste <span class="glyphicon glyphicon-download-alt"></span>
	</a>
	<a type="button" class="btn btn-warning" href="{{ url('contacts/remplir') }}">
		Remplir la table <span class="glyphicon glyphicon-th"></span>
	</a>
</p>
	<?php if(isset($status) && $status==1){
		?>
		<p class="alert alert-success">
		Les modifications ont été effectuées avec succès
		</p>
	<?php
	}
	?>
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">Email</th>
            <th scope="col">Telephone</th>
            <th scope="col">Service</th>
            <th scope="col">Adresse</th>
            <th scope="col">Code Postal</th>
            <th scope="col">Ville</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        
		<?php 
		if(empty($contacts))
		{
			?>
			</body>
			</table>
			<p class="alert alert-info"> Il n'y a pas de contact, pour en ajouter massivement cliquez sur <a href="{{ url('contacts/remplir') }}" class="btn btn-warning" >Remplir la table <i class="glyphicon glyphicon-th"></i></a></p> 
			<?php
		}else
		{
			
			
			foreach($contacts as $contact)
			{
				?>
				<tr>
					<?php
					foreach($contact as $key=>$attribut){
						
						if($key!="id")
							echo "<td>".$attribut."</td>";
						
					}
				?>
					<td>
						<a href="<?php echo url('contacts/edit')."/".$contact->id;?>" type="button" class="btn btn-info">
							<span class="glyphicon glyphicon-pencil"></span>
						</a>
						<a href="<?php echo url('contacts/delete')."/".$contact->id;?>" type="button" class="btn btn-danger">
							<span class="glyphicon glyphicon-trash"></span>
						</a>
					</td>
				</tr>
				<?php
			} ?>
			</tbody>
			</table>
			<?php
		} ?>
@endsection