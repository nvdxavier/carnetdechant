<?php

interface FileHandlerInterface
{
    public function readFile($rootfile);
    public function readDir(string $filesongs);
}
