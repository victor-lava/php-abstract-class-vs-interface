<?php
/* Data for the 2 page types: page and post */
$data = [
    1 => ['title' => 'Home Page', 'body' => 'Lorem ipsum.', 'published' => false,],
    2 => ['title' => 'Installing Laravel', 'body' => 'Lorem ipsum.', 'published' => true]
];

/* Interface that Page Class must implement.
   All of the defined method signatures must be implemented for Page Class*/
interface Template {

  const ACCESSIBLE_BY = 'administrator';

  public function __construct(array $data, int $postId); // Must be implemented with the same signature

  public function getTitle(): string;
  public function getBody(): string;
  public function publish(): void;

}


class Page implements Template {

    private $postId;

    public function __construct(array $data, int $postId) {
        $this->data = $data;
        $this->postId = $postId;
    }

    public function getTitle(): string {
        return $this->data[$this->postId]['title'];
    }

    public function getBody(): string {
        return $this->data[$this->postId]['body'];
    }

    public function publish(): void {
        $this->data[$this->postId]['publish'] = true;
    }
}

$page = new Page($data, 1);
var_dump($page->getTitle());

?>
