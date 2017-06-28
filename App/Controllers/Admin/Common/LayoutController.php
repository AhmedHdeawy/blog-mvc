<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 5/24/17
 * Time: 4:27 AM
 */

namespace App\Controllers\Admin\Common;

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

        $data['header'] = $this->load->controller('Admin/Common/Header')->index();  // Header Design

        $data['sidebar'] = $this->load->controller('Admin/Common/Sidebar')->index(); // Sidebar Design

        $data['footer'] = $this->load->controller('Admin/Common/Footer')->index(); // Footer Design


        return $this->view->render('admin/common/layout', $data);
    }
}