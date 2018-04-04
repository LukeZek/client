<?php

namespace LukeBozek\ApiClient\Model;

class Post extends AbstractModel
{
    protected $title;
    protected $body;
    protected $userId;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function setBody(array $body): array
    {
        $this->body = $body;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    public function getAsArray(): array
    {
        return array_filter(get_object_vars($this));
    }
}
