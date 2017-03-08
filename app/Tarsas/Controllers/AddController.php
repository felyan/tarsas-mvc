<?php

namespace Tarsas\Controllers;

use Tarsas\Models\BookModel;

class AddController extends Controller
{
  private $title;
  private $isbn;
  private $writer;

  public function getTitle()
  {
    return $this->title = $this->post('title');
  }

  public function getIsbn()
  {
    return $this->isbn = $this->post('isbn');
  }

  public function getWriter()
  {
    return $this->writer = $this->post('writer');
  }

  public function __construct()
  {
    parent::__construct();
    $this->bookModel = new bookModel();
    $this->getTitle();
    $this->getIsbn();
    $this->getWriter();
    $this->save();
  }

  public function save()
  {
    if ($this->request('save')) {
      $this->bookModel->newBook([
        'title' => $this->title,
        'isbn' => $this->isbn,
        'writer' => $this->writer
      ]);
    }
  }
}
