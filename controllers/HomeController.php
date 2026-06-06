<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Tab.php';
require_once __DIR__ . '/../models/Slide.php';

final class HomeController
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function index(): void
    {
        $tabModel = new Tab($this->db);
        $slideModel = new Slide($this->db);

        $tabs = $tabModel->all();
        $slidesByTab = $slideModel->groupedByTab();

        require __DIR__ . '/../views/home.php';
    }
}

