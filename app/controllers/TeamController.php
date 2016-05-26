<?php

class TeamController extends ControllerBase
{

    /**
     * Team page
     * Redirect back home since the user doesn't belong here.
     */
    public function indexAction()
    {
        $this->response->redirect('/', true, 404);
    }

    /**
     * Individual members
     */
    public function memberAction()
    {
        if ($member = Team::findFirstByUrl($this->dispatcher->getParam('member'))) {
            $this->view->setVar('member', $member);
        } else {
            $this->response->setStatusCode(404, 'Not Found');
            $this->view->setVar('member', (object) [
                'name'  => '404 - Not Found',
                'title' => 'Team member not found',
                'text'  => 'The person you are looking for doesn\'t exist, or has been removed from the credits.',
                'url'   => '404'
            ]);
        }

        $this->assets->addCss('assets/css/team.css');
        $this->view->setVar('title', 'team');
        $this->view->pick('pages/team');
    }
}

