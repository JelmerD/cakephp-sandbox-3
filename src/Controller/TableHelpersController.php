<?php
namespace App\Controller;

class TableHelpersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->helpers(['TableHelper.Table']);
    }

    public function index()
    {
        # I.L.B.
    }
}