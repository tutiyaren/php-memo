<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Adapter\Repository\PageRepository;
use App\UseCase\GetEditPageUseCase;
use App\Infrastructure\Dao\PageDao;
use App\Adapter\Page\PageMysqlCommand;

$id = $_GET['id'];

$pdo = new PDO('mysql:host=mysql;dbname=memo', 'root', 'password');
$pageRepository = new PageMysqlCommand(new PageDao($pdo));
$getPageUseCase = new GetEditPageUseCase($pageRepository);
$page = $getPageUseCase->readEditPage($id);



?>

<body>
  
  <h2>編集</h2>

  <form method="post" action="./update.php">

    <input type="hidden" name="id" value=<?php echo $page['id']; ?>>

    <div>
      <label for="name">タイトル
        <input type="text" name="title" value=<?php echo $page['title']; ?>>
      </label>
    </div>

    <div>
      <label for="content">感想
        <input type="textarea" name="content" value=<?php echo $page[
            'content'
        ]; ?>>
      </label>
    </div>

    <button type="submit">更新</button>
    
  </form>

</body>