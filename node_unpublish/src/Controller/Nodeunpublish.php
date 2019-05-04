<?php 
namespace Drupal\node_unpublish\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
Class Nodeunpublish extends Controllerbase{
	public function content(){
		$node = Node::load(8);
		$node->status = 0;
        $node->save();
		return drupal_set_message("Node with nid " . $node->id() . " saved!\n");
	}
} 



