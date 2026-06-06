<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Tab.php';
require_once __DIR__ . '/../models/Slide.php';
require_once __DIR__ . '/../config/Upload.php';

final class AdminController
{
    private Tab $tabs;
    private Slide $slides;

    public function __construct(private readonly PDO $db)
    {
        $this->tabs = new Tab($db);
        $this->slides = new Slide($db);
    }

    public function handle(): void
    {
        $resource = $_GET['resource'] ?? 'tabs';
        $action = $_GET['action'] ?? 'index';

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->handlePost($resource, $action);
            }

            $this->renderPage($resource, $action);
        } catch (Throwable $exception) {
            $error = $exception->getMessage();
            $this->renderPage($resource, $action, $error);
        }
    }

    private function handlePost(string $resource, string $action): void
    {
        verify_csrf();

        if ($resource === 'tabs') {
            if ($action === 'delete') {
                $this->tabs->delete((int) ($_GET['id'] ?? 0));
                redirect(admin_url('resource=tabs'));
            }

            $this->saveTab($action);
            redirect(admin_url('resource=tabs'));
        }

        if ($resource === 'slides') {
            if ($action === 'delete') {
                $this->slides->delete((int) ($_GET['id'] ?? 0));
                redirect(admin_url('resource=slides'));
            }

            $this->saveSlide($action);
            redirect(admin_url('resource=slides'));
        }
    }

    private function renderPage(string $resource, string $action, ?string $error = null): void
    {
        $tabs = $this->tabs->all();
        $slides = $this->slides->all();
        $editingTab = null;
        $editingSlide = null;

        if ($resource === 'tabs' && $action === 'edit') {
            $editingTab = $this->tabs->find((int) ($_GET['id'] ?? 0));
        }

        if ($resource === 'slides' && $action === 'edit') {
            $editingSlide = $this->slides->find((int) ($_GET['id'] ?? 0));
        }

        require __DIR__ . '/../views/admin/layout.php';
    }

    private function saveTab(string $action): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $current = $id > 0 ? $this->tabs->find($id) : null;
        $icon = Upload::image($_FILES['icon'] ?? [], $current['icon'] ?? null);

        $data = [
            'title' => trim((string) ($_POST['title'] ?? '')),
            'icon' => $icon,
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        if ($data['title'] === '') {
            throw new InvalidArgumentException('Tab title is required.');
        }

        if ($action === 'edit' && $id > 0) {
            $this->tabs->update($id, $data);
            return;
        }

        $this->tabs->create($data);
    }

    private function saveSlide(string $action): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $current = $id > 0 ? $this->slides->find($id) : null;
        $image = Upload::image($_FILES['image'] ?? [], $current['image'] ?? null);

        $data = [
            'tab_id' => (int) ($_POST['tab_id'] ?? 0),
            'tag' => trim((string) ($_POST['tag'] ?? '')),
            'title' => trim((string) ($_POST['title'] ?? '')),
            'image' => $image,
            'learn_more_link' => trim((string) ($_POST['learn_more_link'] ?? '#')),
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];

        if ($data['tab_id'] <= 0 || $data['title'] === '' || $data['tag'] === '') {
            throw new InvalidArgumentException('Tab, tag, and slide title are required.');
        }

        if ($action === 'edit' && $id > 0) {
            $this->slides->update($id, $data);
            return;
        }

        if (!$data['image']) {
            throw new InvalidArgumentException('Slide image is required.');
        }

        $this->slides->create($data);
    }

}
