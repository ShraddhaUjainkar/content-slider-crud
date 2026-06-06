<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/Database.php';

final class Tab
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function all(): array
    {
        $stmt = $this->db->query('SELECT * FROM tabs ORDER BY sort_order ASC, id ASC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM tabs WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $tab = $stmt->fetch();

        return $tab ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO tabs (title, icon, sort_order) VALUES (:title, :icon, :sort_order)'
        );
        $stmt->execute([
            'title' => $data['title'],
            'icon' => $data['icon'],
            'sort_order' => $data['sort_order'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare(
            'UPDATE tabs SET title = :title, icon = :icon, sort_order = :sort_order WHERE id = :id'
        );
        $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'icon' => $data['icon'],
            'sort_order' => $data['sort_order'],
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM tabs WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}

