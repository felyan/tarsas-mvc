<?php

namespace Tarsas\Controllers;

use Tarsas\Models\BookModel;

class SearchController extends Controller
{
  protected $bookModel;
  protected $type;
  protected $search;
  protected $books;

  public function __construct()
  {
    parent::__construct();
    $this->bookModel = new bookModel();
    $this->getType();
    $this->getSearch();
    $this->doSearch();
  }

  public function getType()
  {
    $this->type = $this->request('type');
  }

  public function getSearch()
  {
    $this->search = $this->request('search');
  }

  public function typeSelect($type)
  {
    if ($this->type == $type) {
      return 'selected';
    }
  }

  public function doSearch()
  {
    if ($this->search) {
      $this->books = $this->bookModel->getByValues([
        $this->type => $this->search
      ]);
    }
  }
}
