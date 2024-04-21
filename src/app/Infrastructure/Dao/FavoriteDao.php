<?php
namespace App\Infrastructure\Dao;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Page_favorite\NewPage_favorite;
use App\Domain\ValueObject\Page_favorite\EditPage_favorite;
use App\Domain\Entity\Page_favorites;
use \PDO;
use PDOException;

final class FavoriteDao
{
    const TABLE_NAME = 'page_favorites';
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:dbname=memo;host=mysql;charset=utf8',
                'root',
                'password'
            );
        } catch(PDOException $e) {
            exit('DB接続エラー:　' . $e->getMessage());
        }
    }

    public function create(Page_favorites $favorite)
    {
        $sql = sprintf(
            'INSERT INTO %s (page_id, status, created_at, updated_at) VALUES (:page_id, 1, NOW(), NOW())',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':page_id', $favorite->page_id()->value(), PDO::PARAM_INT);
        $statement->execute();
    }

    public function update(EditPage_favorite $favorite)
    {
        $sql = sprintf(
            'UPDATE page_favorites SET status = 1 - status WHERE page_id = :page_id',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':page_id', $favorite->page_id()->value(), PDO::PARAM_INT);
        $statement->execute();
    }

    public function getPageId(int $id): array
    {
        $sql = sprintf(
          'SELECT * FROM page_favorites WHERE page_id = :page_id',
          self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':page_id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result ?: [];
        
    }
}
