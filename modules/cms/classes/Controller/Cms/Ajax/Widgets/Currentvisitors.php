<?php defined('SYSPATH') or die('No direct script access.');class Controller_Cms_Ajax_Widgets_Currentvisitors extends Controller {		public function action_get()	{		$visitors = ORM::factory('Visitor')->find_all();		$varray = array();		if((bool)$visitors->count())		{			foreach($visitors as $visitor)			{				$varray[] = $visitor->info();			}		}		ajax::success('ok', array(			'visitors' => $varray		));	}	}