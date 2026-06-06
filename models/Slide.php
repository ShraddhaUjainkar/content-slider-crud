<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/Database.php';

final class Slide
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function all(): array
    {
        $stmt = $this->db->query(
            'SELECT slides.*, tabs.title AS tab_title
             FROM slides
             INNER JOIN tabs ON tabs.id = slides.tab_id
             ORDER BY tabs.sort_order ASC, slides.sort_order ASC, slides.id ASC'
        );

        return $stmt->fetchAll();
    }

    public function groupedByTab(): array
    {
        $stmt = $this->db->query('SELECT * FROM slides ORDER BY sort_order ASC, id ASC');
        $slides = [];

        foreach ($stmt->fetchAll() as $slide) {
            $slides[(int) $slide['tab_id']][] = $slide;
        }

        return $slides;
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM slides WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $slide = $stmt->fetch();

        return $slide ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO slides (tab_id, tag, title, image, learn_more_link, sort_order)
             VALUES (:tab_id, :tag, :title, :image, :learn_more_link, :sort_order)'
        );
        $stmt->execute($this->payload($data));
    }

    public function update(int $id, array $data): void
    {
        $payload = $this->payload($data);
        $payload['id'] = $id;

        $stmt = $this->db->prepare(
            'UPDATE slides
             SET tab_id = :tab_id, tag = :tag, title = :title, image = :image,
                 learn_more_link = :learn_more_link, sort_order = :sort_order
             WHERE id = :id'
        );
        $stmt->execute($payload);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM slides WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    private function payload(array $data): array
    {
        return [
            'tab_id' => $data['tab_id'],
            'tag' => $data['tag'],
            'title' => $data['title'],
            'image' => $data['image'],
            'learn_more_link' => $data['learn_more_link'],
            'sort_order' => $data['sort_order'],
        ];
    }
}

