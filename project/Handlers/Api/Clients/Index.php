<?php

namespace Project\Handlers\Api\Clients;

use Project\Databases\Connection;
use Project\Handlers\BaseHandler;
use Project\Response\Failure;
use Project\Routing\Request;
use Project\User\Auth;

class Index extends BaseHandler
{
    /**
     * @var Auth
     */
    protected $auth;
    protected $db;

    protected $currentPage = 1;
    protected $perPage = 100;
    protected $where = ['sql' => '', 'params' => []];
    protected $total;
    protected $lastPage;

    /**
     * Login constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->db = Connection::getInstance();
        $this->auth = new Auth();
    }

    /**
     * Handle the route request.
     *
     * @return string
     */
    public function handle()
    {
        if ( ! $this->auth->isLoggedIn()) {
            return new Failure();
        }

        $this->setWhereClause();
        $this->setTotalAndPageInfo();

        return $this->getClientsPaginator();
    }

    /**
     * Gives you the clients for the current page and the total number of clients
     * in the system for the current filter settings.
     *
     * @return array
     */
    protected function getClientsPaginator()
    {
        $clients = $this->db->getAll(
            'SELECT * FROM clients ' .
            $this->where['sql'] .
            ' ORDER BY first_name, last_name' .
            ' LIMIT ' . $this->perPage .
            ' OFFSET ' . (int)($this->perPage * $this->currentPage),
            $this->where['params']
        );

        return [
            'total' => $this->total,
            'current_page' => $this->currentPage,
            'per_page' => $this->perPage,
            'last_page' => $this->lastPage,
            'data' => $clients,
        ];
    }

    /**
     * Build and set the WHERE clause.
     */
    protected function setWhereClause()
    {
        $this->where = [
            'sql' => 'WHERE 1=1',
            'params' => [],
        ];

        if ($id = $this->request->param('id')) {
            $this->where['sql'] .= ' AND id = ?';
            $this->where['params'][] = $id;
        }

        if ($name = $this->request->param('name')) {
            $this->where['sql'] .= ' AND (first_name LIKE ? OR last_name LIKE ?)';
            $this->where['params'][] = '%' . $name . '%';
            $this->where['params'][] = '%' . $name . '%';
        }
    }

    /**
     * Set the total count and page info.
     */
    protected function setTotalAndPageInfo()
    {
        $this->total = (int)$this->db->getOne(
            'SELECT COUNT(*) FROM clients ' . $this->where['sql'],
            $this->where['params']
        );

        $this->lastPage = (int)floor($this->total / $this->perPage);

        if ($this->total % $this->perPage === 0) {
            $this->lastPage--;
        }

        if ($this->request->param('page') > 1) {
            $this->currentPage = (int)$this->request->param('page');
        }

        $this->currentPage = $this->currentPage <= $this->lastPage
            ? $this->currentPage
            : $this->lastPage;
    }
}