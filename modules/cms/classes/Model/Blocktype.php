<?php defined('SYSPATH') or die('No direct script access.');
class Model_Blocktype extends ORM {
	
	protected $_belongs_to = array(
		'contenttype' => array(),
	);
	
	protected $_has_many = array(
		'blocks' => array(),
		'metas' => array('model' => 'Blocktype_Meta'),
	);
	
			$new->parent = $newparent;
		}
	public function meta($key)
	{
		$meta = $this->metas->where('key','=',$key)->find();
		if(!$meta->loaded())
		{
			return false;
		}
		return $meta->value;
	}
	
}