<?php

class IndexController extends Zend_Controller_Action
{
    public function preDispatch()
    {
        $auth = Zend_Auth::getInstance();
        if ($this->getRequest()->getQuery('openid_mode') || $this->getRequest()->getQuery('openid_mode')) {
            $result = $auth->authenticate(new Zend_Auth_Adapter_OpenId());
            if (!$result->isValid()) {
                $auth->clearIdentity();
            }
        }

        if (!$auth->hasIdentity()) {
            $adapter = new Zend_Auth_Adapter_OpenId('https://www.e-contract.be/eid-idp/endpoints/openid-identity/xrds');
            $auth->authenticate($adapter);
        }
    }

    public function indexAction()
    {

    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
    }
}
