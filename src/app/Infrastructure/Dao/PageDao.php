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
}
