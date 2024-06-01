<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Page\PageId;
use App\Domain\ValueObject\Page\PageTitle;
use App\Domain\ValueObject\Page\PageContent;
use App\UseCase\UseCaseInput\EditPageInput;
use App\UseCase\UseCaseInteractor\EditPageInteractor;
use APp\UseCase\UseCaseOutput\EditPageOutput;

$id = filter_input(INPUT_POST, 'id');
$title = filter_input(INPUT_POST, 'title');
$content = filter_input(INPUT_POST, 'content');

try {
    session_start();
    if(empty($title) || empty($content)) {
        throw new Exception('タイトルまたは内容を入力して');
    }
    $id = new PageId($id);
    $pageTitle = new PageTitle($title);
    $pageContent = new PageContent($content);
    $useCaseInput = new EditPageInput($id, $pageTitle, $pageContent);
    $useCase = new EditPageInteractor($useCaseInput);
    $useCaseOutput = $useCase->handler();

    if(!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();
    Redirect::handler('/index.php');
} catch(Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['user']['title'] = $title;
    $_SESSION['user']['content'] = $content;
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

// $id = filter_input(INPUT_POST, 'id');
// $title = filter_input(INPUT_POST, 'title');
// $content = filter_input(INPUT_POST, 'content');

// if (!empty($title) && !empty($content)) {
//     $sql = 'UPDATE pages SET title=:title, content=:content WHERE id = :id';
//     $statement = $pdo->prepare($sql);
//     $statement->bindValue(':id', $id, PDO::PARAM_INT);
//     $statement->bindValue(':title', $title, PDO::PARAM_STR);
//     $statement->bindValue(':content', $content, PDO::PARAM_STR);
//     $statement->execute();

//     header('Location: ./index.php');
//     exit();
// }
// $error = 'タイトルまたは本文が入力されていません';
// ?>

<body>
  <div>
    <?php foreach ($errors as $error): ?>
      <p><?php echo $error; ?></p>
    <?php endforeach; ?>
    <a href="./index.php">
        <p>トップページへ</p>
    </a>
  </div>
</body>
