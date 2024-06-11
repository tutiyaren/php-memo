<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Adapter\Repository\PageRepository;
use App\UseCase\GetAllPageUseCase;
use App\Infrastructure\Dao\PageDao;
use App\Adapter\Page\PageMysqlCommand;
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $dbUserName,
    $dbPassword
);

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$pageAllRepository = new PageMysqlCommand(new PageDao($pdo));
$getAllUseCase = new GetAllPageUseCase($pageAllRepository);
if (!empty($keyword)) {
    $pages = $getAllUseCase->searchAllPage($keyword);
}
if(empty($keyword)) {
    $pages = $getAllUseCase->readAllPage();
}

$date_format = 'Y年m月d日H時i分s秒';

foreach ($pages as $key => $value) {
    $standard_key_array[$key] = $value['created_at'];
}
array_multisort($standard_key_array, SORT_DESC, $pages);

?>

<head>
  <link href="https://use.fontawesome.com/releases/v6.5.2/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/modal.css">
</head>
<body>

  <div class="search">
    <form method="GET">
      <input type="text" name="keyword" placeholder="Search..." value="<?php echo $keyword ?>">
      <button type="submit" name="search">検索</button>
    </form>
  </div>

  <div class="addMemo">
    <a href="./create.php">メモを追加</a><br>
  </div>

  <div>
    <?php foreach ($errors as $error): ?>
      <p><?php echo $error; ?></p>
    <?php endforeach; ?>
  </div>

  <div class="body">
    <table border="1">
      <tr>
        <th>タイトル</th>
        <th>内容</th>
        <th>作成日時</th>
        <th>マーク</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($pages as $page): ?>
        <tr>
          <td><?php echo $page['title']; ?></td>
          <td><?php echo $page['content']; ?></td>
          <td><?php echo date($date_format, strtotime($page['created_at'])); ?></td>
          <td style="text-align: center;">
              <form action="./toggle.php" class="toggleForm" method="post" style="margin-top: 50%;">
                  <button type="submit" class="toggleAlert">
                    <?php if ($page['status'] == 1): ?>
                        <i class="fa-solid fa-fire" style="color: red;"></i>
                    <?php endif; ?>
                    <?php if ($page['status'] == 0): ?>
                        <i class="fa-solid fa-fire" style="color: pink;"></i>
                    <?php endif; ?>
                    <input type="hidden" name="page_id" value="<?php echo $page['id']; ?>">
                    <input type="hidden" name="status" value="<?php echo $page['status'] == 1 ? 0 : 1; ?>">
                  </button>
              </form>
          </td>
          <td><a href="./edit.php?id=<?php echo $page['id']; ?>">編集</a></td>
          <td><a href="#" id="deleteMemo" class="deleteLink" data-id="<?php echo $page['id']; ?>" data-title="<?php echo $page['title']; ?>" data-content="<?php echo $page['content']; ?>">削除</a></td>
        </tr>
      <?php endforeach; ?>
    </table>

  </div>

  <div class="modal-overlay">
    <div class="form">
      <form action="./delete.php" id="deleteForm" method="post" class="delete-form">
        <input type="hidden" name="id" id="deleteId">
        <p class="form-title"><span>このメモを削除しますか？</span></p>
        <p><input class="title" type="title" name="title" id="deleteTitle" readonly></p>
        <p><textarea class="content" name="content" id="deleteContent" readonly></textarea></p>
        <button class="deleteButton">削除</button>
        <button class="return">戻る</button>
      </form>
    </div>
  </div>

  <script src="./js/main.js"></script>
</body>