<?php
class template
{
	private $masterPage;
	private $contentPage;

	/*public function template()
	 {

	}*/

	public function template($master_page_path)
	{
		$bt =  debug_backtrace();
		$this->contentPage = $bt[0]['file'];
		if (is_string($master_page_path) && file_exists($master_page_path))
		{
			$this->masterPage = $master_page_path;
		}
		else
		{
			throw new RuntimeException("Le fichier de contenu spécifié est introuvable.");
		}
	}

	public function render()
	{
		// Get the Masterpage informations
		$documentMP = new DOMDocument("1.0", "UTF-8");
		$documentMP->load($this->masterPage);
		$rootMP = $documentMP->documentElement;
		$contentPlaceHoldersMP = $documentMP->getElementsByTagName("contentPlaceHolder");
		$contentPlaceHoldersMPLength = $contentPlaceHoldersMP->length;

		// Get the Content page informations
		$documentCP = new DOMDocument("1.0", "UTF-8");
		$documentCP->load($this->contentPage);
		$rootCP = $documentCP->documentElement;
		$contentPlaceHoldersCP = $documentCP->getElementsByTagName("contentPlaceHolder");
		$contentPlaceHoldersCPLength = $contentPlaceHoldersCP->length;

		// DEBUG
		//echo 'MP:' . $contentPlaceHoldersMPLength . ', CP:' . $contentPlaceHoldersCPLength . '<br/>';

		// Pour chaque contentPlaceHolder dans la MP
		for ($i = 0; $i < $contentPlaceHoldersMPLength; $i++)
		{
			// Recherche de l'id du contentPlaceHolder i
			$itemMP = $contentPlaceHoldersMP->item($i);
			$itemAttributeMP = $itemMP->attributes;
			$idMP = $itemAttributeMP->getNamedItem("id");
				
			// Pour chaque contentPlaceHolder dans la CP
			for ($j = 0; $j < $contentPlaceHoldersCPLength; $j++)
			{
				// Recherche de l'id du contentPlaceHolder j
				$itemCP = $contentPlaceHoldersCP->item($j);
				$itemAttributeCP = $itemCP->attributes;
				$idCP = $itemAttributeCP->getNamedItem("id");

				// Si l'id du contentPlaceHolder de la MP et l'id du contentPlaceHolder dans la CP
				// sont identiques.

				// DEBUG
				//echo 'IF: idMP:' . $idMP->nodeValue . ' et idCP:' . $idCP->nodeValue . '<br/>';
				if (!is_null($idMP) && !is_null($idCP) && $idMP->nodeValue == $idCP->nodeValue)
				{
					// Récupère la liste des noeuds
					$contentNodeList = $itemCP->childNodes;
					$contentNodeCount = $contentNodeList->length;
					// Pour chaque noeuds à l'intérieur du contentPlaceHolder de la CP
					for ($k = 0; $k < $contentNodeCount; $k++)
					{
						// Insère les noeuds avant le contentPlaceHolder correspondant
						// dans la MP
						$contentNode = $contentNodeList->item($k);
						$parent = $itemMP->parentNode;
						$importedNode = $documentMP->importNode($contentNode, TRUE);
						if($importedNode->nodeName != "#text")
						{
							// DEBUG
							//echo 'i:' . $i . ', j:' . $j . ', k:' . $k . '<br/>';
							//echo 'parent:' . $parent->nodeName . ', importedNode:' . $importedNode->nodeName . ', itemMP:' . $itemMP->nodeName . '<br/>';
							$parent->insertBefore($importedNode, $itemMP);
							//$itemCP->parentNode->removeChild($itemCP);
						}
					}
				}
				//$itemMP->parentNode->removeChild($itemMP);
			}
		}
		$cphsToRemove = $documentMP->getElementsByTagName("contentPlaceHolder");
		$cphsToRemoveCount = $cphsToRemove->length;
		for ($i = 0; $i < $cphsToRemoveCount; $i++)
		{
			$itemToRemove = $cphsToRemove->item(0);
			$itemToRemove->parentNode->removeChild($itemToRemove);
		}

		echo $documentMP->saveHTML();
		exit;
	}

	public function setMasterPage(String $master_page_path)
	{
		if (is_string($master_page_path) && file_exists($master_page_path))
		{
			$this->masterPage = $master_page_path;
		}
		else
		{
			throw new RuntimeException("Le fichier de contenu spécifié est introuvable.");
		}
	}

	public function setContentPage(String $content_page_path)
	{
		if (is_string($content_page_path) && file_exists($content_page_path))
		{
			$this->contentPage = $content_page_path;
		}
		else
		{
			throw new RuntimeException("Le fichier de contenu spécifié est introuvable.");
		}
	}
}
?>