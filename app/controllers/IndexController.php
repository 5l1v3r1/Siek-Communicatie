<?php

use \PHPMailer\PHPMailer;
use \PHPMailer\PHPMailerException;

class IndexController extends ControllerBase
{

    /**
     * Home page
     */
    public function indexAction()
    {
        /* Add CSS assets */
        $this->assets->addCss('share/plugins/font-awesome/css/font-awesome.min.css');
        $this->assets->addCss('share/plugins/litebox/css/litebox.css');
        $this->assets->addCss('assets/css/index.css');

        /* Add JS assets */
        $this->assets->addJs('share/plugins/litebox/js/litebox.min.js');
        $this->assets->addJs('share/plugins/litebox/js/images-loaded.min.js');
        $this->assets->addJs('assets/js/index.js');

        /* Add references and team */
        $this->view->setVar('team', Team::find());
        $this->view->setVar('references', References::find());

        /* Set text */
        $this->view->setVars([
            'text_what' => Content::findText('index', 'what'),
            'text_about' => Content::findText('index', 'about')
        ]);

        /* Pick view */
        $this->view->pick('pages/index');
    }

    /**
     * Contact page
     */
    public function contactAction()
    {

        /**
         * Check for a form submit
         */
        if ($this->request->isPost() && $this->security->checkToken()) {
            $this->view->setVar('form_sent', true);

            /**
             * Create a new contact model
             */
            $contact = new Contact();
            $contact->time    = date('Y-m-d h:i:s', time());
            $contact->ip      = $this->request->getClientAddress(false);
            $contact->browser = $this->request->getUserAgent();
            $contact->email   = $this->request->getPost('email');
            $contact->subject = $this->request->getPost('subject');
            $contact->message = $this->request->getPost('message');


            /**
             * Save the message in the database
             * then send it over to my email
             */
            if (
                $this->request->hasPost('anti-spam') &&
                $this->request->getPost('anti-spam') == '' &&
                $this->request->hasPost('spam-question') &&
                $this->request->getPost('spam-question') == ("e" || "E") &&
                $contact->validation() &&
                $contact->save()
            ) {

                /**
                 * Generate an email template
                 * This is done by cloning the view
                 * Then disabling the main layout render level (prevents all useless crap from being added)
                 * Then getting the render as a string.
                 * (This took WAY too long to figure out)
                 */
                $mailTemplate = clone $this->view;
                $mailTemplate->setMainView('mail');
                $mailTemplate->setVar('title', 'Bericht verstuurd via het contact formulier');
                $mailTemplate->setVar('id', $contact->id);
                $mailTemplate->setVar('ip', $contact->ip);
                $mailTemplate->setVar('time', $contact->time);
                $mailTemplate->setVar('email', $contact->email);
                $mailTemplate->setVar('subject', $contact->subject);
                $mailTemplate->setVar('message', $contact->message);


                /**
                 * Send email to self
                 */
                try {
                    $mail = new PHPMailer(true);
                    $mail->AddAddress($this->config->email->adminEmail);
                    $mail->setFrom($this->config->email->noreplyAddress, 'SIEK');
                    $mail->AddReplyTo($this->config->email->noreplyAddress);
                    $mail->Subject = 'SIEK - Bericht verstuurd via het contact formulier';
                    $mail->MsgHTML($mailTemplate->getRender('emails', 'admin/contact'));
                    $mail->send();
                } catch (phpmailerException $e) {
                    error_log('Email was not sent via PHPMailer:');
                    error_log($e->errorMessage());
                } catch (Exception $e) {
                    error_log('Email was not sent via PHPMailer:');
                    error_log($e->getMessage());
                }


                /**
                 * Show that the message was sent successfully
                 */
                $this->view->setVar('form_success', true);
                $this->view->setVar('form_message', 'Bericht succesful verstuurd, we zullen proberen zo snel mogelijk te anwtoorden.');
            } else {
                $this->view->setVar('form_success', false);
                $this->view->setVar('form_message', 'Niet alle velden zijn correct ingevuld.');
            }
        } else {
            $this->view->setVar('form_sent', false);
        }

        /* View settings */
        $this->assets->addCss('share/plugins/font-awesome/css/font-awesome.min.css');
        $this->assets->addCss('assets/css/contact.css');
        $this->view->setVar('title', 'contact');
        $this->view->setVars([
            'links' => [
                'phone'    => Content::findText('contact', 'phone'),
                'envelope' => Content::findText('contact', 'email'),
                'facebook' => Content::findText('contact', 'facebook'),
                'twitter'  => Content::findText('contact', 'twitter')
            ],
            'text_description' => Content::findText('contact', 'description')
        ]);
        $this->view->pick('pages/contact');
    }

    /**
     * Services page
     */
    public function dienstenAction()
    {
        $this->view->setVars([
            'text_main' => Content::findText('diensten', 'main'),
            'title' => 'diensten'
        ]);
        $this->view->pick('pages/diensten');
    }

    /**
     * 404 page.
     */
    public function notFoundAction()
    {
        $this->response->setStatusCode(404, 'Not Found');
        $this->assets->addCss('assets/css/404.css');
        $this->view->setVar('title', '404');
        $this->view->pick('pages/404');
    }
}

