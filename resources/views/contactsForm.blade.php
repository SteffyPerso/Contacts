@extends("default")

@section("content")
<h1 class="heading-title"> <?php echo $titre; ?> de contact </h1>
<form action="<?php if($action==1){ echo url("contacts/add"); } else { echo url("contacts/edit")."/".$contact[0]->id; } ?>" method="POST">
{{ csrf_field() }}
	<?php if(isset($error))
	{ ?>
		<p class="alert alert-danger" >
			Veuillez vérifier les champs obligatoires.
		</p>
	<?php
	}
	?>
	<div class="row" style="padding-left:10px;">
		<div class="col-md-6 col-sm-6 col-lg-6">
		<input type="hidden" name="action" value="<?php echo $action;?>"/>
			<div class="form-group">
				<label for="prenom">Prénom *</label>
				<input type="text" name="prenom" <?php if(isset($error)){ ?> style="border:1px solid red;" <?php }?> class="form-control" required aria-describedby="prenomHelp" id="prenom" placeholder="Prénom" value="<?php if(isset($contact) && isset($contact[0])){ echo $contact[0]->prenom; }?>" >
				<?php if(isset($error)){ ?> <small style="color:red;" id="prenomHelp" class="form-text text-muted"> Ce champ prénom est obligatoire </small> <?php }?>
			 </div>
			 <div class="form-group">
				<label for="nom">Nom *</label>
				<input type="text" id="nom" name="nom" <?php if(isset($error)){ ?> style="border:1px solid red;" <?php }?> class="form-control"  required id="Nom" aria-describedby="nomHelp" placeholder="Nom" value="<?php if(isset($contact) && isset($contact[0])){ echo $contact[0]->nom; }?>">
				<?php if(isset($error)){ ?> <small style="color:red;" id="nomHelp" class="form-text text-muted"> Ce champ prénom est obligatoire </small> <?php }?>
			 </div>
			 <div class="form-group">
				<label for="date_naissance">Date de naissance</label>
				<input type="date" name="date_naissance" class="form-control" id="date_naissance" placeholder="date de naissance" value="<?php if(isset($contact) && isset($contact[0])){ echo $contact[0]->date_naissance; }?>">
			 </div>
			 <div class="form-group">
				<label for="telephone">Téléphone</label>
				<input type="text" name="telephone" class="form-control" id="telephone" placeholder="Numéro de téléphone" value="<?php if(isset($contact) && isset($contact[0])){ echo $contact[0]->telephone; }?>">
			 </div>
			 <div class="form-group">
				<label for="service">Service</label>
				<input type="text" name="service" class="form-control" id="service" placeholder="Service" value="<?php if(isset($contact) && isset($contact[0])){ echo $contact[0]->service; }?>">
			 </div>
		 </div>
		 <div class="col-md-6 col-sm-6 col-lg-6">
		
			 <div class="form-group">
				<label for="email" >Email *</label>
				<input <?php if(isset($error)){ ?> style="border:1px solid red;" <?php }?> type="email" name="email" class="form-control" required id="email" aria-describedby="emailHelp" placeholder="Adresse mail" value="<?php if(isset($contact) && isset($contact[0])){ echo $contact[0]->email; }?>">
				<?php if(isset($error)){ ?> <small  style="color:red;" id="emailHelp" class="form-text text-muted"> L'adresse email doit être xxx@yyy.zz </small> <?php }?>
  
			 </div>
			 <div class="form-group">
				<label for="adresse">Adresse</label>
				<textarea class="form-control" name="adresse" id="adresse" placeholder="Adresse postale" ><?php if(isset($contact) && isset($contact[0])){ echo $contact[0]->adresse; }?></textarea>
			 </div>
			 
			 <div class="form-group">
				<label for="cp">Code Postal</label>
				<input type="text" class="form-control" name="cp" id="cp" placeholder="Code postal" value="<?php if(isset($contact) && isset($contact[0])){ echo $contact[0]->cp; }?>"/>
			 </div>
			 <div class="form-group">
				<label for="ville">Ville</label>
				<input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="<?php if(isset($contact) && isset($contact[0])){ echo $contact[0]->ville; }?>"/>
			 </div>
		 </div>
	 </div>
	 <div class="row">
		<div class="col-md-offset-4 col-sm-offset-4 col-lg-offset-4 col-md-2 col-sm-2 col-lg-2">
			<button type="submit" class="btn btn-success">
				Valider <span class="glyphicon glyphicon-valid"></span>
			</button>
		</div>
		<div class="col-md-2 col-sm-2 col-lg-2">
			<a href="{{ url('contacts') }}" class="btn btn-danger">
				Annuler <span class="glyphicon glyphicon-close"></span>
			</a>
		</div>
		
	 </div>
</form>
<script>
$('#prenom, #nom').keyup(function(event){
	
	 $(this).val( $(this).val().substring(0,1).toUpperCase()+$(this).val().substring(1,$(this).val().length).toLowerCase() );
	
});
</script>
@endsection