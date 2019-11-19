<?php

$data = [
    1 => ['title' => 'Home Page', 'body' => 'Lorem ipsum.', 'published' => false],
    2 => ['title' => 'Installing Laravel', 'body' => 'Lorem ipsum.', 'published' => true, 'comments' => ['1', '2']]
];

interface TemplateInterface {
    public function __construct(array $data, int $postId);

    public function getTitle(): string;
    public function getBody(): string;
}

interface CommentInterface {
    public function getComments(): array;
}

abstract class Template implements TemplateInterface {

    const ACCESSIBLE_BY = 'administrator';

    protected $postId; // Extended in the other classes. Doesn't work in interface.

    public function __construct(array $data, int $postId) { // Extended in the other classes. Doesn't work in interface.
        $this->data = $data;
        $this->postId = $postId;
    }

    public function getTitle(): string { // Extended in the other classes. Doesn't work in interface.
        return $this->data[$this->postId]['title'];
    }

    public function getBody(): string { // Extended in the other classes. Doesn't work in interface.
        return $this->data[$this->postId]['body'];
    }

    abstract protected function publish(): void; // You must define this method, similar like in interface.

}

class Page extends Template {

    const ACCESSIBLE_BY = "editor";

    protected function publish(): void {
        $this->data[$this->postId]['publish'] = true;
    }

}

class Post extends Template implements CommentInterface {

    const ACCESSIBLE_BY = "manager";

    public function getComments(): array {
        return $this->data[$this->postId]['comments'];
    }

    protected function publish(): void {
        $this->data[$this->postId]['publish'] = true;
    }
}

$page = new Page($data, 1);
var_dump($page->getTitle());

$post = new Post($data, 2);
var_dump($post->getComments());

?>
