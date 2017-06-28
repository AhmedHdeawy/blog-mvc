<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/27/17
 * Time: 6:01 AM
 */

namespace System;


class Pagination
{
    /**
     * Application Object
     * @var \System\Application
     */
    private $app;

    /**
     * Total Number of items
     * @var int
     */
    private $totalItems;

    /**
     * items pre page
     * @var int
     */
    private $itemsPrePage = 2;

    /**
     * last page
     * @var int
     */
    private $lastPage;

    /**
     * Offset
     * @var int
     */
    private $offset;

    /**
     * Current page number
     * @var int
     */
    private $page = 1;

    /**
     * Constructor
     * @param \System\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->setPage();
    }

    /**
     * Set Current Page
     */
    public function setPage()
    {
        // ?page=1
        // ?page=2
        // ?page=2

        $page = $this->app->request->get('page');
        // simple validation
        if(! is_numeric($page) OR $page < 1) {
            $page = 1;
        }

        $this->page = $page;
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set total items
     * @param int $totalItems
     * @return $this
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * Set  items per page
     * @param int $itemsPerPage
     * @return $this
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPrePage = $itemsPerPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getItemsPrePage()
    {
        return $this->itemsPrePage;
    }

    /**
     * Set Last page
     */
    public function setLastPage()
    {
        $lastPage = ceil($this->totalItems / $this->itemsPrePage);

        $this->lastPage = $lastPage;
    }

    /**
     * @return int
     */
    public function getLastPage()
    {
        return $this->lastPage;
    }


    /**
     * Start Application
     * @return $this
     */
    public function paginate()
    {
        $this->setLastPage();
        return $this;
    }

}