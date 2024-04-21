<?php
namespace App\Infrastructure\Dao;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Page\NewPage;
use App\Domain\ValueObject\Page\EditPage;
use \PDO;
use PDOException;

final class PageDao
{
    const TABLE_NAME = 'pages';
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
            exit('DB接続エラー: ' . $e->getMessage());
        }
    }

    public function create(NewPage $page): void
    {
        $sql = sprintf(
            'INSERT INTO %s (title, content) VALUES (:title, :content)',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':title', $page->title()->value(), PDO::PARAM_STR);
        $statement->bindValue(':content', $page->content()->value(), PDO::PARAM_STR);
        $statement->execute();
    }

    public function update(EditPage $page): void
    {
        $sql = sprintf(
            'UPDATE %s SET title = :title, content = :content WHERE id = :id',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $page->id()->value(),
            ':title' => $page->title()->value(),
            ':content' => $page->content()->value(),
        ));
    }

    public function readEdit($id)
    {
        $sql = sprintf(
            'SELECT * FROM %s WHERE id = :id',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function allPage()
    {
        $sql = sprintf(
            'SELECT pages.*, page_favorites.status FROM %s LEFT JOIN page_favorites ON pages.id = page_favorites.page_id',
            self::TABLE_NAME
        );
        $statement = $this->pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchPage($keyword)
    {
        $sql = sprintf(
            'SELECT pages.*,  page_favorites.status FROM %s LEFT JOIN page_favorites ON pages.id = page_favorites.page_id WHERE title LIKE ?',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['%' . $keyword . '%']);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
