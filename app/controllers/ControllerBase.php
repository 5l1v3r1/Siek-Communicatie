<?php

use \Phalcon\Mvc\Controller;
use \MobileDetect\MobileDetect;

class ControllerBase extends Controller
{
    public function initialize()
    {
        /**
         * Browser detection
         * @var boolean
         */
        $detect = new MobileDetect();
        $this->view->setVar('isMobile',  $detect->isMobile());
        $this->view->setVar('isTablet',  $detect->isTablet());
        $this->view->setVar('isChrome',  (strpos($this->request->getUserAgent(), 'Chrome')  !== false));
        $this->view->setVar('isFirefox', (strpos($this->request->getUserAgent(), 'Firefox') !== false));
        $this->view->setVar('isSafari',  (strpos($this->request->getUserAgent(), 'Safari')  !== false));
        $this->view->setVar('isOpera',   (strpos($this->request->getUserAgent(), 'Opera')   !== false));
        $this->view->setVar('isMSIE',    (strpos($this->request->getUserAgent(), 'MSIE')    !== false));

        /**
         * Credits
         * Seen in the source.
         * @var object
         */
        $this->view->credits = Credits::find();

        /**
         * SEO meta description
         * Only shown if robots should follow.
         * @var object
         */
        $this->view->seo = ((object) [
            'description' => '',
            'keywords' => ''
        ]);

        /**
         * Add a global stylesheet
         */
        $this->assets->addCss('assets/css/global.css');
        $this->assets->addJs('assets/js/global.js');
    }
}
