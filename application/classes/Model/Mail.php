<?php defined('SYSPATH') or die('No direct script access.');class Model_Mail extends ORM {		protected $_belongs_to = array(		'mailtemplate' => array()	);		public $from = false;		public function url()	{		/*		 * Bit of an ugly hack to hardcode the URL since $_SERVER['SERVER_NAME'] isn't set in a CLI environment.		 * The proper fix is to use a config file instead, but I'm a little busy (I fully expect this to come back and bite me in the ass).		 */		return 'http://morningpages.net/mail/show/'.$this->token;		//return url::site('mail/show/' . $this->token, 'http');	}		public function to($email)	{		$this->to = $email;		return $this;	}		public function subject($subject)	{		$this->subject = $subject;		return $this;	}		public function content($content, $tokens = array())	{		if((bool)count($tokens))		{			foreach($tokens as $key => $value)			{				str_replace('['.$key.']',$value, $content);			}		}		$this->content = $content;		return $this;	}		public function type($type)	{		$this->type = $type;		return $this;	}		public function from($email = false)	{		$this->from = $email;		return $this;	}		public function send()	{		$this->save();				$from = site::option('emailfrom');		if($this->from)		{			$from = $this->from;		}				$headers = "Content-type: text/html; charset=UTF-8\r\nFrom:".site::option('sitename')." <".$from.">";		$message = View::factory('templates/mail');		$message->mail = $this;		try		{			if(mail($this->to, $this->subject, $message, $headers))			{				 $this->sent = time();				 $this->save();				 return true;			}		}		catch(exception $e)		{			log::instance()->exception('Couldnt send mail! ID: '.$this->id, $e);		}		return false;	}		public function tokenize($tokens = array())	{		if((bool)count($tokens))		{			foreach($tokens as $key => $value)			{				$this->content = str_replace('['.$key.']',$value, $this->content);				$this->subject = str_replace('['.$key.']',$value, $this->subject);			}		}		return $this;	}		public function save(Validation $val = null)	{		if(!$this->loaded())		{			$this->created = time();		}		return parent::save($val);	}	}