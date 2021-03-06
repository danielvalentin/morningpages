<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Me extends Controller_Project {
	
	public function action_index()
	{
		$this->require_login();
		$this->bind('user',user::get());
		seo::instance()->title("Morning Pages Profile");
		seo::instance()->description("By default, Morning Pages has private profiles. If you'd like, however, you may turn it on at any time.");
	}
	
	public function action_profile()
	{
		$user = $this->request->param('user');
		$this->template->view = View::factory('Me/index');
		$this->bind('user',$user);
		seo::instance()->title("Morning Pages Profile");
		seo::instance()->description("By default, Morning Pages has private profiles. If you'd like, however, you may turn it on at any time.");
	}
	
	public function action_notpublic()
	{
		seo::instance()->title("Morning Pages Profile");
		seo::instance()->description("This Morning Pages profile is private.");
	}
	
}
