<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Page\PageId;
use App\Domain\ValueObject\Page\PageTitle;
use App\Domain\ValueObject\Page\PageContent;
use App\UseCase\UseCaseInput\CreatePageInput;
use App\UseCase\UseCaseInteractor\CreatePageInteractor;
use App\Adapter\Page\PageMysqlCommand;
use App\Adapter\Page\PageMysqlQuery;

$title = filter_input(INPUT_POST, 'title');
$content = filter_input(INPUT_POST, 'content');

try {
    session_start();
    if(empty($title) || empty($content)) {
        throw new Exception('タイトルまたは本文が入力されていません');
    }
    $pageTitle = new PageTitle($title);
    $pageContent = new PageContent($content);
    $usseCaseInput = new CreatePageInput($pageTitle, $pageContent);
    $pageMysqlQuery = new PageMysqlQuery();
    $pageMysqlCommand = new PageMysqlCommand();
    $useCase = new CreatePageInteractor($usseCaseInput, $pageMysqlQuery, $pageMysqlCommand);
    $useCaseOutput = $useCase->run();
    if(!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();
    Redirect::handler('/index.php');
} catch(Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['title'] = $title;
    $_SESSION['content'] = $content;
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']);
}

// $dbUserName = 'root';
// $dbPassword = 'password';
// $pdo = new PDO(
//     'mysql:host=mysql; dbname=memo; charset=utf8',
//     $dbUserName,
//     $dbPassword
// );

// $content = filter_input(INPUT_POST, 'content');
// $title = filter_input(INPUT_POST, 'title');

// // [解説！]ガード節になっている
// if (!empty($title) && !empty($content)) {
//     $sql = 'INSERT INTO `pages`(`title`, `content`) VALUES(:title, :content)';
//     $statement = $pdo->prepare($sql);
//     $statement->bindValue(':title', $title, PDO::PARAM_STR);
//     $statement->bindValue(':content', $content, PDO::PARAM_STR);
//     $statement->execute();

//     // [解説！]リダイレクト処理
//     header('Location: ./index.php');
//     // [解説！]リダイレクトしても処理が一番下まで続いてしまうので「exit」しておこう！！！
//     exit();
// }
// $error = 'タイトルまたは本文が入力されていません';
?>

<body>
  <div>
    <?php foreach ($errors as $error): ?>
      <p><?php echo $error; ?></p>
    <?php endforeach; ?>
  </div>
  <div>
    <a href="./index.php">
        <p>トップページへ</p>
    </a>
  </div>
</body>