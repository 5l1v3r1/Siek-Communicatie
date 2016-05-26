<?php


class BlogController extends ControllerBase
{
    /**
     * Initialisation
     */
    public function onConstruct()
    {
        $this->assets->addCss('assets/css/blog.css');
        $this->view->setVar('title', 'blog');
        $this->view->setVar('navigation', []);
        $this->view->setVar('recent_posts', Blog::find(array(
            'limit' => 10,
            'order' => 'date DESC'
        )));
    }


    /**
     * Get the most recent post(s)
     * @param int $page
     */
    public function indexAction($page = 0)
    {

        /**
         * Add the navigation
         */
        $navigation = \Paradoxis\MVC\URL::getBlogPageNavigation('/blog/page/', $page, '/blog');
        $results = Blog::find(array(
            'limit' => 4,
                        'offset' => $page * 4,
            'order' => 'date DESC'
        ));

        /**
         * Set view variables
         */
        $this->view->setVar('navigation', $navigation);
        $this->view->setVar('posts', $results);
        if (($this->request->hasQuery('title') && $this->request->getQuery('title') == '') || count($results) <= 0) {
            $this->response->setStatusCode(404, 'Not Found');
            $this->view->setVar('noIndex', true);
            $this->view->setVar('noFollow', false);
            $results = array();
        }

        /**
         * Pick the view
         */
        $this->view->pick('pages/blog/index');
    }


    /**
     * Search for posts
     */
    public function searchAction($page = 0)
    {


        /**
         * Find blog posts
         * @var array|object|null $results
         */
        $results = Blog::find([
            "conditions" => "title LIKE :title:",
            "limit" => 4,
            "offset" => $page * 4,
            "order" => 'date DESC',
            "bind" => [
                'title' => "%".$this->request->getQuery('title')."%"
            ]
        ]);

        /**
         * Check if any blog posts match given criteria
         */
        if ($this->request->getQuery('title') == '' || count($results) < 1) {
            $this->response->setStatusCode(404, 'Not Found');
        $this->view->setVar('noIndex', true);
        $this->view->setVar('noFollow', false);
            $results = array();
        }

        /**
         * Set up navigation
         */
        $navigation = \Paradoxis\MVC\URL::getBlogPageNavigation('/blog/search/page/', $page, '/blog/search');

        /**
         * Add the search query to the navigation
         */
        foreach($navigation as $item) {
            $item->url = $item->url.'?title='.$this->request->getQuery('title');
        }

        /**
         * Set view variables
         */
        $this->view->setVar('navigation', $navigation);
        $this->view->setVar('search_query', $this->request->getQuery('title'));
        $this->view->setVar('is_search', true);
    $this->view->setVar('posts', $results);
    $this->view->setVar('posts_count', Blog::find([
            "conditions" => "title LIKE :title:",
            "order" => 'date DESC',
            "bind" => [
                'title' => "%".$this->request->getQuery('title')."%"
            ]
        ])->count());


        /**
         * Render the view
         */
        $this->view->pick('pages/blog/search');
    }


    /**
     * View a post
     * @param int $year
     * @param int $month
     * @param int $day
     * @param string $url
     */
    public function postAction($year = null, $month = null, $day = null, $url = null)
    {
        /**
         * Fetch blog post from the database
         */
        $result = Blog::findFirst([
            'order' => 'date DESC',
            "conditions" => "YEAR(date) = :year: AND MONTH(date) = :month: AND DAY(date) = :day: AND url = :url:",
            "bind" => [
                'year'  => $year,
                'month' => $month,
                'day'   => $day,
                'url'   => $url
            ]
        ]);

        /**
         * Check if the post exists
         */
        if ($result == false) {
            $this->response->setStatusCode(404, 'Not Found');
            $this->view->setVar('noIndex', true);
            $this->view->setVar('noFollow', false);
            $result = false;
        }

        /**
         * Set the post as a variable
         */
        $this->view->setVar('post', $result);
        $this->view->setVar('title', $result->title);
        $this->view->pick('pages/blog/post');
    }
}
