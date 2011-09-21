<?php
require("template.php");
$temp = new template("Master.html");
$temp->render();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<temp:templateContent xmlns:temp="http://templates"
	xmlns="http://www.w3.org/1999/xhtml">
	<temp:contentPlaceHolder id="head">
		<title>À propos de nous</title>
	</temp:contentPlaceHolder>
	<temp:contentPlaceHolder id="content">
		<div id="divBacBleu">
			<img alt="Bac bleu" src="images/bac_bleu_decor.png" id="bacBleu" />
		</div>
		<div id="text">
			<h1>HISTORIQUE</h1>
			<p>Fondée en 1999, Plastique M.R. est une compagnie qui a su se
				tailler une place solide dans la production à petite et grande
				échelle de pièces en matériaux composites. Son équipe de direction
				cumule plusieurs années d'expérience dans la fabrication
				industrielle de pièces pour une clientèle tant manufacturière que
				commerciale et institutionnelle.</p>
			<p>Aujourd'hui, Plastique M.R. possède une équipe de plus d’une
				vingtaine d’employés, tous animés de la même passion. Notre
				entreprise est reconnue pour sa grande capacité d’adaptation et son
				sens de l’urgence auprès de ses clients. Soumises à des normes de
				qualités très strictes, les activités de Plastique M.R. visent
				principalement la production et l’assemblage de composantes en
				matériaux composites pour le domaine du transport, de l’agriculture,
				de l’aquaculture et de la construction.</p>
			<p>Nous soulignons aussi que l’entreprise a développé une gamme de
				produits liée au domaine de l’environnement. Conçus à notre usine,
				nos îlots de cueillette sélective pour le recyclage et l’élimination
				des déchets se retrouvent maintenant dans plusieurs écoles,
				universités, municipalités et commerces de la province.</p>
			<p>L’objectif de Plastique M.R. est de rencontrer et de maintenir les
				exigences de qualité de ses clients tout en leur permettant de
				demeurer compétitif sur leurs marchés respectifs.</p>
		</div>
	</temp:contentPlaceHolder>
</temp:templateContent>
