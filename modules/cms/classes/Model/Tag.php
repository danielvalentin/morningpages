<?php defined('SYSPATH') or die('No direct script access.');class Model_Tag extends ORM {		protected $_belongs_to = array(		'content' => array(),		'contenttype' => array(),	);		protected $_has_many = array(		'files' => array('through' => 'files_tags')	);		protected $_sorting = array(		'slug' => 'ASC'	);		public function __toString()	{		return $this->tag;	}		public function info()	{		return array(			'id' => $this->id,			'tag' => $this->tag,			'slug' => $this->slug		);	}	}