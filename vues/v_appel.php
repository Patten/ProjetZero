<section>

		
		<section id="content">
			<fieldset id ="fieldset">
				<legend>Cours</legend>
				

				<?php // remplissage de la comboBox avec les spécialisation
					foreach ($tabTrombi as $unePhoto){
						echo "<div name='".$unePhoto['idEtu']."' class='photo'>";
							if($unePhoto['photoEtu']=='')	echo "<img src='images/default.jpg' width='100px' height='100px' alt='trombi'/>";
							else							echo "<img src='images/".$unePhoto['photoEtu']."'width='100px' height='100px' alt='trombi'/>";
							echo $unePhoto['nomEtu']."<br/>";
							echo $unePhoto['prenomEtu'];						
							echo "<div class='abs' name=".$unePhoto['idEtu']."></div>"; 
						echo "</div>";	
					}
			//		echo "<div id='idUtilisateur' name=".$_SESSION['id']."></div>";
				?>
						<div class="clear"></div>
						<input type="submit" onClick="confAbs()"/>	
				
				<script>
				alert("");
				var idUtilisateur = <?php echo json_encode($_SESSION['id']); ?>;
				var heureDeb = <?php echo json_encode($_POST['heureDeb']); ?>;
				var heureFin = <?php echo json_encode($_POST['heureFin']); ?>;
				
					
				var tabAbs= new Array();
				
					$('.abs').click(function(){
						if($(this).css("opacity") == 0){
							$(this).fadeTo('fast',0.7);
							
							//tabAbs.push($(this).attr("name"));
							tabAbs[$(this).attr("name")] = $(this).attr("name");
						}
						else{
							//delete tabAbs[tabAbs.indexOf($(this).attr("name"))]
							//tabAbs.splice(tabAbs.indexOf($(this).attr("name")), 1); 
							delete tabAbs[$(this).attr("name")];
							$(this).fadeTo('fast',0);
							
						}
					});

					
					 setTimeout("confAbs()",10000); //3 600 000 pour une Heure
					 
					 function confAbs(){ // fonction confirmation des absents
					  
						if(confirm("Les élèves séléctionnés vont être comfirmés absents.")){
					
							for(unAbs in tabAbs){
								ajouterAbsence(unAbs, idUtilisateur, heureDeb, heureFin);
							}
							
						}

					 }
					 function ajouterAbsence(unAbs, idUti){
						$.ajax({
							type:"POST",
							data:"&unAbs="+ unAbs+"&idUti="+idUti+"&heureDeb="+heureDeb+"&heureFin="+heureFin,
							url:"model/m_ajouterAbs.php",
							dataType:"html",
							success:function(data){
								window.location="index.php";
							}
						});
					}
					 
				</script>

			</fieldset>
			
		
			<div class="clear"></div>
		</section>
	</div>
</section>
			