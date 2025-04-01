<?php

class AdminSearch extends Controller
{
    private $searchModel;

    public function __construct()
    {
        $this->searchModel = new AdminSearchModel();
    }

    public function index()
    {
        $query = $_GET['query'] ?? '';

        if (!empty($query)) {
            $results = $this->searchModel->search($query);
        } else {
            $results = [];
        }

        $this->render('', ['results' => $results, 'query' => $query]);
    }
}
