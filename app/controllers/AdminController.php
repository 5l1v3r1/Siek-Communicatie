<?php

/**
 * Class AdminController
 */
class AdminController extends ControllerBase
{
    /**
     * Authentication object
     * @var $auth \Paradoxis\Security\Auth
     */
    private $auth;

    /**
     * On construct
     * @return void
     */
    public function onConstruct()
    {
        /**
         * Load all default assets
         * Also set up basic configuration
         */

        $this->view->noIndex  = true;
        $this->view->noFollow = true;

        /**
         * Set up authentication
         */
        $this->auth = new \Paradoxis\Security\Auth();
        $this->assets->addCss('share/plugins/font-awesome/css/font-awesome.min.css');

        /**
         * The login wall.
         */
        if ($this->auth->isAuthenticated() == false) {
            if ($this->request->getURI() != "/admin") {
                $this->response->redirect('admin', null, 403);
                return;
            } else {
                $this->assets->addCss('assets/css/admin.css');
                $this->view->pick("pages/admin/login");
                return;
            }
        } else {
            $this->assets->addCss('assets/css/admin.panel.css');
            $this->view->isAdmin = $this->session->get('user')->admin;
        }
    }

    /**
     * Index action
     * @return void
     */
    public function indexAction()
    {
        if ($this->auth->isAuthenticated()) {
            $this->view->pick("pages/admin/home");
        } else {
            if (
                $this->request->isPost() &&
                $this->security->checkToken() &&
                $this->request->hasPost('username') &&
                $this->request->hasPost('password') &&
                $this->request->hasPost('login')
            ) {

                if ($this->auth->authenticate(
                    $this->request->getPost('username'),
                    $this->request->getPost('password')
                )) {
                    $this->response->redirect('admin');
                } else {
                    $this->view->setVar('messages', $this->auth->getMessages());
                    $this->view->pick("pages/admin/login");
                    sleep(2);
                }
            } else {
                $this->view->pick("pages/admin/login");
            }
        }
    }

    /**
     * Logout
     * @return void
     */
    public function logoutAction()
    {
        $this->session->destroy();
        $this->response->redirect('admin', null, 403);
        return;
    }

    /**
     * Blog editor
     * @param int $start
     * @return void
     */
    public function blogAction($start = 0)
    {
        // Load the list of posts
        $this->view->setVar('page', 'blog');
        $this->view->setVar('user', $this->session->get('user'));
        $this->view->setVar('list', Blog::find([
            "conditions" => "(author = :author: OR :isAdmin: = 1)",
            "limit" => ["number" => 15, "offset" => $start * 15],
            "order" => "id DESC",
            "bind" =>  [
                "author"  => $this->session->get('user')->name,
                "isAdmin" => $this->session->get('user')->admin
            ]
        ]));

        // Post deleted message
        // @see blogDeleteAction()
        if ($this->session->has('postDeleted')) {
            $this->view->setVar('postDeleted', $this->session->get('postDeleted'));
            $this->session->remove('postDeleted');
        }

        // Render view
        $this->view->pick("pages/admin/blog/overview");
    }

    /**
     * Create a new post
     * @return void
     */
    public function blogNewAction()
    {
        // Check if the blog was posted
        if ($this->request->isPost() && $this->security->checkToken()) {
            $post = new Blog();
            $post->url    = $this->request->getPost('title');
            $post->title  = $this->request->getPost('title');
            $post->text   = $this->request->getPost('message');
            $post->author = $this->session->get('user')->name;
            $post->date   = $this->request->getPost('date');

            // The form was sent
            $this->view->setVar("form_sent", true);

            // Validation
            if ($post->validation()) {
                if ($post->save()) {
                    $this->view->setVar("form_success", true);
                    $this->view->setVar("form_message", "Blog post successvol bijgewerkt / geplaatst.");
                } else {
                    $this->view->setVar("form_success", false);
                    $this->view->setVar("form_message", "Niet alle velden zijn correct ingevuld.");
                    error_log("\nFailed to add blog message: ".print_r($post->getMessages(), true));
                }
            } else {
                $this->view->setVar("form_success", false);
                $this->view->setVar("form_message", "Niet alle velden zijn correct ingevuld.");
                error_log("\nFailed to add blog message: ".print_r($post->getMessages(), true));
            }
        } else {
            $this->view->setVar("form_sent", false);
        }

        // Render the view
        $this->assets->addJs('share/plugins/jquery/jquery.selection.js');
        $this->assets->addJs('assets/js/editor.js');
        $this->view->setVar('form_action', 'new');
        $this->view->setVar('action', 'new');
        $this->view->pick('pages/admin/blog/form');
    }

    /**
     * Edit a post
     * @param int $id
     * @return void
     */
    public function blogEditAction($id = 0)
    {

        if ($post = Blog::findFirst([
            "conditions" => "id = :id: AND (author = :author: OR :isAdmin: = 1)",
            "bind" =>  [
                "id" => $id,
                "author"  => $this->session->get('user')->name,
                "isAdmin" => $this->session->get('user')->admin
            ]
        ])) {

            // Edit post
            if ($this->request->isPost() && $this->security->checkToken()) {
                $post->url    = $this->request->getPost('title');
                $post->title  = $this->request->getPost('title');
                $post->text   = $this->request->getPost('message');
                $post->date   = $this->request->getPost('date');

                // The form was sent
                $this->view->setVar("form_sent", true);

                // Validation
                if ($post->validation()) {
                    if ($post->save()) {
                        $this->view->setVar("form_success", true);
                        $this->view->setVar("form_message", "Blog post successvol bijgewerkt / geplaatst.");
                    } else {
                        $this->view->setVar("form_success", false);
                        $this->view->setVar("form_message", "Niet alle velden zijn correct ingevuld.");
                        error_log("\nFailed to add blog message: ".print_r($post->getMessages(), true));
                    }
                } else {
                    $this->view->setVar("form_success", false);
                    $this->view->setVar("form_message", "Niet alle velden zijn correct ingevuld.");
                    error_log("\nFailed to add blog message: ".print_r($post->getMessages(), true));
                }
            } else {
                $this->view->setVar("form_sent", false);
            }

            // Add the post to the view
            $this->view->setVar('post', $post);
        } else {
            $this->view->setVar('post', null);
        }

        $this->assets->addJs("//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js", false);
        $this->assets->addJs('share/plugins/jquery/jquery.selection.js');
        $this->assets->addJs('assets/js/editor.js');
        $this->view->setVar('form_action', 'edit/'.$id);
        $this->view->setVar('action', 'edit');
        $this->view->pick('pages/admin/blog/form');
    }

    /**
     * Delete a post
     * @param int $id
     * @return void
     */
    public function blogDeleteAction($id = 0)
    {
        if ($post = Blog::findFirst([
            "conditions" => "id = :id: AND (author = :author: OR :isAdmin: = 1)",
            "bind" =>  [
                "id" => $id,
                "author"  => $this->session->get('user')->name,
                "isAdmin" => $this->session->get('user')->admin
            ]
        ])) {
            $post->delete();
            $this->session->set('postDeleted', true);
        } else {
            $this->session->set('postDeleted', false);
        }

        // Forward the request
        $this->response->redirect('admin/blog');
    }

    /**
     * Pages overview
     * @return void
     */
    public  function pageAction() {

        // Check for admin
        if ($this->session->get('user')->admin == false) {
            $this->response->redirect('/admin', false, 403);
            return;
        }

        // Fetch all pages
        // Double check admin for extra security
        $this->view->setVar('page', 'pages');
        $this->view->setVar('user', $this->session->get('user'));
        $this->view->setVar('list', Content::find([
            "conditions" => ":isAdmin: = 1",
            "order" => "id",
            "bind" =>  [
                "isAdmin" => $this->session->get('user')->admin
            ]
        ]));

        // Render view
        $this->view->pick("pages/admin/pages/overview");
    }

    /**
     * Edit page
     * @return void
     */
    public function pageEditAction($page, $section) {

        // Check for admin
        if ($this->session->get('user')->admin == false) {
            $this->response->redirect('/admin', false, 403);
            return;
        }

        // Set up the editor
        // This never really took off, no time left
        $editor = new \Paradoxis\MVC\Editor();
        //$editor->

        // Fetch page, and dispatch it to the editor
        // IF THOU ARE NOT AN ADMIN THOU SHALL NOT PASS
        $this->view->setVar('page', $page);
        $this->view->setVar('section', $section);
        $this->view->setVar('user', $this->session->get('user'));
        $this->view->setVar('list', Content::find([
            "conditions" => ":isAdmin: = 1 AND page = :page: AND section = :section:",
            "order" => "page, section, id",
            "bind" =>  [
                "isAdmin" => $this->session->get('user')->admin,
                "section" => $section,
                "page" => $page
            ]
        ]));
        $this->view->setVar('editor', $editor->getProperties());

        // Include angularJS
        $this->assets->addJs("share/plugins/angular/angular.min.js");
        $this->assets->addJs("assets/js/editor.js", true);
        $this->view->pick("pages/admin/pages/form");
    }
}
