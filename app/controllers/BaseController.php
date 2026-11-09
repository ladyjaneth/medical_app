<?php

abstract class BaseController
{
    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        require_once __DIR__ . "/../views/{$view}.php";
    }
}