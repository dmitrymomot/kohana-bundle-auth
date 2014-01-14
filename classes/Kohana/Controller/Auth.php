<?php defined('SYSPATH') OR die('No direct script access.');

class Kohana_Controller_Auth extends Controller_Template {

	/**
	 * @var array
	 */
	public $config;

	/**
	 * @var string
	 */
	public $content;

	/**
	 * @var string
	 */
	public $success_url;

	/**
	 * @var string|object instance of View
	 */
	public $template = 'auth/index';

	public function before()
	{
		parent::before();

		// load config
		$this->config = $config = Kohana::$config->load('auth');

		// set template view
		$this->template->set_filename($config->get('template', 'auth/index'));

		// Set correct referrer URI
		if ( ! $this->request->referrer()
			OR strpos($this->request->referrer(), $this->request->action()) !== FALSE
			OR $this->request->uri() == $this->request->referrer())
		{
			$referrer = ($this->request->query('ref')) ? $this->request->query('ref') : URL::base();
			$this->request->referrer($referrer);
		}
	}

	public function action_login()
	{
		if (Auth::instance()->logged_in())
		{
			$this->redirect($this->request->referrer());
		}

		if ($this->request->method() === Request::POST)
		{
			$data = $this->request->post();
			$validation = $this->_login_validation($data);

			if ($validation->check())
			{
				$login = Auth::instance()->login(
					$data['login'],
					$data['password'],
					isset($data['remember'])
				);

				if ($login)
				{
					$this->redirect($this->request->referrer());
				}

				Message::set(Message::ERROR, __('Invalid username or password'));
			}

			Message::set(Message::ERROR, $validation->errors('validation/auth', TRUE));
		}

		$captcha_view = ($this->config['captcha']) ? $this->_captcha() : FALSE;

		$this->content = View::factory('auth/login')
			->set('action', URL::site($this->request->uri()))
			->set('login', $this->request->post('login'))
			->set('remember', (bool)$this->request->post('remember'))
			->set('csrf', Security::token())
			->set('captcha_view', $captcha_view);
	}

	public function action_logout()
	{
		if ( ! Auth::instance()->logged_in())
		{
			$this->redirect($this->request->referrer());
		}

        Auth::instance()->logout(TRUE);
        Session::instance()->delete('initial_user');
		$this->redirect($this->request->referrer());
	}

	public function action_signup()
	{
		if (Auth::instance()->logged_in())
		{
			$this->redirect($this->request->referrer());
		}

	}

	public function action_remind()
	{
		if (Auth::instance()->logged_in())
		{
			$this->redirect($this->request->referrer());
		}

	}

	public function action_confirm()
	{

	}

	public function action_login_as()
	{
		if ( ! Auth::instance()->logged_in())
		{
			$this->redirect($this->request->referrer());
		}

	}

	public function action_comeback()
	{
		if ( ! Auth::instance()->logged_in())
		{
			$this->redirect($this->request->referrer());
		}

	}

	public function after()
	{
		$this->template->content = $this->content;
		$this->template->messages = Message::render('bootstrap3');

		parent::after();
	}

	/**
	 * Generated captcha
	 *
	 * @return string
	 */
	protected function _captcha()
	{
        $captcha = Captcha::instance($this->config['captcha']);
        return $captcha->render();
	}

	/**
	 * @param array $data
	 * @return object // instance of class Validation
	 */
	protected function _login_validation(array $data)
	{
		$validation = Validation::factory($data)
			->rule('login', 'not_empty')
			->rule('password', 'not_empty')
			->rule('csrf', 'not_empty')
			->rule('csrf', 'Security::check')
			->labels(array(
				'login'  	=> UTF8::ucfirst(__('login')),
				'password'  => UTF8::ucfirst(__('password')),
			));

		if ($this->config['captcha'])
		{
			$validation
				->rule('captcha', 'not_empty')
				->rule('captcha', 'Captcha::valid')
				->label('captcha', UTF8::ucfirst(__('answer')));
		}

		return $validation;
	}
}
