<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/24/17
 * Time: 4:27 AM
 */

namespace App\Controllers\Blog\Common;

use System\Controller;
use System\View\ViewInterface;

class LayoutController extends Controller
{

    /**
     * Render the layout with the given View
     *
     * @param \System\View\ViewInterface $view
     */
    public function render(ViewInterface $view)
    {
        $data['content'] = $view;

        $data['header'] = $this->load->controller('Blog/Common/Header')->index();  // Header Design

        $data['footer'] = $this->load->controller('Blog/Common/Footer')->index(); // Footer Design

        $data['sidebar'] = $this->load->controller('Blog/Common/Sidebar')->index(); // Sidebar Design

        return $this->view->render('blog/common/layout', $data);
    }
}