<?php
class ControllerExtensionModuleCaptchaBasic extends Controller {
	public function index($error = array()) {
		$this->load->language('extension/module/captcha/basic');

		if (isset($error['captcha'])) {
			$data['error_captcha'] = $error['captcha'];
		} else {
			$data['error_captcha'] = '';
		}

		$data['route'] = 'common/login'; 
		$this->session->data['captcha'] = substr(sha1(mt_rand()), 17, 6);
		$data['captcha']=$this->session->data['captcha'];

		return $this->load->view('extension/module/captcha/basic', $data);
	}

	public function validate() {
		$this->load->language('extension/module/captcha/basic');

		if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
			return $this->language->get('error_captcha');
		}
	}
}
